<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Показ формы для ввода email для отправки ссылки на регистрацию
    public function showRegistrationLinkRequestForm()
    {
        return view('auth.registers.email'); // Шаблон с формой для ввода email
    }


    // Отправка ссылки на завершение регистрации
    public function sendRegistrationLinkEmail(Request $request)
    {
        // Валидация email
        $request->validate(['email' => 'required|email']);

        // Проверка, существует ли пользователь с таким email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Генерация уникального токена для регистрации
            $token = Str::random(60);

            // Сохранение токена в таблицу registration_resets
            DB::table('registration_resets')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => Hash::make($token), // Токен сохраняется в зашифрованном виде
                    'created_at' => now(),
                ]
            );

            // Создание ссылки для завершения регистрации
            $registrationLink = url('register/complete', $token) . '?email=' . urlencode($request->email);

            // Формирование письма
            $to = $request->input('email');
            $subject = "Завершение регистрации на сайте";
            $message = "Для завершения регистрации перейдите по следующей ссылке: " . $registrationLink;
            $headers = "From: info@mtscybercup.ru";

            // Отправка письма с использованием стандартной PHP-функции mail()
            if (mail($to, $subject, $message, $headers)) {
                return back()->with('status', 'Ссылка для завершения регистрации отправлена на ваш email!');
            } else {
                return back()->withErrors(['email' => 'Ошибка при отправке сообщения.']);
            }
        } else {
            // Перенаправление на страницу входа, если пользователь уже существует
            return redirect()->route('login')->with('status', 'Пользователь с таким email уже существует. Пожалуйста, войдите.');
        }
    }


    // Показ формы завершения регистрации
    public function showRegistrationForm($token)
    {
        $email = request('email');
        return view('auth.registers.complete', ['token' => $token, 'email' => $email]);
    }

    // Обработка завершения регистрации
    public function completeRegistration(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
            'email' => 'required|email',
            'telegram' => 'required|string|max:50',
            'avatar' => 'nullable|image|max:5120', 
        ]);

        // Поиск записи с токеном
        $record = DB::table('registration_resets')->where('email', $request->email)->first();

        if ($record && Hash::check($request->token, $record->token) && !$this->tokenExpired($record->created_at)) {
            // Обработка загрузки аватара
            $avatarName = null;
            if ($request->hasFile('avatar')) {
                $avatarName = time() . '_' . uniqid() . '.' . $request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('avatars'), $avatarName);
            }

            // Создание нового пользователя
            User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telegram' => $request->telegram,
                'avatar' => $avatarName,
            ]);

            // Удаление записи токена после успешной регистрации
            DB::table('registration_resets')->where('email', $request->email)->delete();

            // Отправка email пользователю после входа
            $to = $request->email;
            $subject = 'Удачная регистрация на сайте!';
            $message = 'Здравствуйте, ' . $request->name . "\n\n"
                . 'Регистрация произошла удачно!';

            // Добавляем заголовки
            $headers = "From: info@mtscybercup.ru" . "\r\n" .
                "Reply-To: support@mtscybercup.ru" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();

            // Отправка письма через функцию mail
            mail($to, $subject, $message, $headers);

            return redirect('/login')->with('status', 'Регистрация успешно завершена!');
        } else {
            return back()->withErrors(['token' => 'Неверный или истёкший токен.']);
        }
    }

    // Проверка, истёк ли токен
    protected function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addHours(2)->isPast();
    }

    // Валидация данных пользователя
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'patronymic' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telegram' => ['required', 'string', 'max:50'],
            'avatar' => ['nullable', 'image', 'max:5120'], // Максимальный размер изображения — 5MB
        ]);
    }

    // Создание пользователя
    protected function create(array $data)
    {
        $avatarName = null;
        if (isset($data['avatar'])) {
            $uploadPath = public_path('avatars');
            $avatarName = time() . '_' . uniqid() . '.' . $data['avatar']->getClientOriginalExtension();
            $data['avatar']->move($uploadPath, $avatarName);
        }

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'patronymic' => $data['patronymic'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'telegram' => $data['telegram'],
            'avatar' => $avatarName,
        ]);
    }
}
