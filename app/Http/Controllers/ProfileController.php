<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use App\Models\UserOfflineStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the profile edit form
   

    // Handle the profile update
 
    public function profileedit(Request $request)
    {
        // Валидация данных
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:50',
            'surname' => 'nullable|max:50',
            'patronymic' => 'nullable|max:50',
            'telegram' => 'nullable|max:50',
            'email' => 'nullable|email|max:70',
            'password' => 'nullable|confirmed|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Если валидация не проходит, возвращаем JSON ошибки для AJAX
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    
        // Обновляем данные пользователя
        $user = Auth::user();
    
        if ($request->hasFile('avatar')) {
            $uploadPath = public_path('avatars');
            $avatarName = time() . '_' . uniqid() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move($uploadPath, $avatarName);
            $user->avatar = $avatarName;
        }
    
        // Обновляем другие данные, только если они изменены
        if ($request->input('name') && $request->input('name') !== $user->name) {
            $user->name = $request->input('name');
        }
    
        if ($request->input('surname') && $request->input('surname') !== $user->surname) {
            $user->surname = $request->input('surname');
        }
    
        if ($request->input('patronymic') && $request->input('patronymic') !== $user->patronymic) {
            $user->patronymic = $request->input('patronymic');
        }
    
        if ($request->input('telegram') && $request->input('telegram') !== $user->telegram) {
            $user->telegram = $request->input('telegram');
        }
    
        if ($request->input('email') && $request->input('email') !== $user->email) {
            $user->email = $request->input('email');
        }
    
        // Если пароль изменён
        if ($request->input('password') && !empty($request->input('password'))) {
            $user->password = bcrypt($request->input('password'));
        }
    
        // Сохраняем пользователя
        $user->save();
    
        // Отправка email уведомления после успешного изменения профиля
        $to = $user->email;
        $subject = 'Изменение профиля';
        $message = 'Здравствуйте, ' . $user->name . "\n\n"
                 . 'Ваш профиль был успешно изменен. Если это были не вы, пожалуйста, немедленно смените пароль или свяжитесь со службой поддержки.';
    
        // Заголовки письма
        $headers = "From: info@mtscybercup.ru" . "\r\n" .
                   "Reply-To: mtscybercup.ru" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();
    
        // Отправка письма
        mail($to, $subject, $message, $headers);
    
        // Возвращаем успешный ответ с параметром ?modal=profileModal
        return redirect()->back()->with('success', true)->with('modal', 'profileModal');
    }
    
    

    public function offlineModal(Request $request)
    {
        $request->validate([
            'offline' => 'required|string|in:Да,Нет',
        ]);
    
        // Получаем авторизованного пользователя
        $user = Auth::user();
    
        // Сохраняем статус в новую таблицу
        UserOfflineStatus::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'offline' => $request->offline,
        ]);
    
        // Возвращаем ответ
        return response()->json(['message' => 'Статус успешно обновлен!'], 200);
    }


    public function profileDelete(Request $request)
    {
        // Получаем текущего пользователя
        $user = Auth::user();
        
        // Удаляем пользователя
        if ($user) {
            $user->delete(); // Удаление пользователя

            // Завершаем сессию
            Auth::logout();

            // Перенаправляем на страницу логина
            return redirect()->route('login')->with('status', 'Ваш аккаунт был успешно удалён.');
        }

        return redirect()->back()->withErrors(['Не удалось удалить аккаунт. Попробуйте позже.']);
    }


}
