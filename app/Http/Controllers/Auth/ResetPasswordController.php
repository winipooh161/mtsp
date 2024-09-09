<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        // Проверяем, существует ли запись с этим токеном в таблице password_resets
        $reset = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$reset || !Hash::check($token, $reset->token)) {
            return redirect()->route('password.request')->withErrors(['email' => 'Недействительная или устаревшая ссылка для сброса пароля.']);
        }

        // Если токен валиден, показываем форму сброса пароля
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
 
      
    }

    public function reset(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        // Получаем запись из таблицы password_resets по email
        $reset = DB::table('password_resets')->where('email', $request->email)->first();

        // Проверка токена
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return redirect()->route('password.request')->withErrors(['email' => 'Недействительная или устаревшая ссылка для сброса пароля.']);
        }

        // Найти пользователя по email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('password.request')->withErrors(['email' => 'Пользователь с таким email не найден.']);
        }

        // Сменить пароль
        $user->password = Hash::make($request->password);
        $user->save();

        // Удалить запись с токеном после успешного сброса пароля
        DB::table('password_resets')->where('email', $request->email)->delete();

        // Автоматически авторизовать пользователя (необязательно)
        Auth::login($user);

        // Перенаправить пользователя на страницу входа или в личный кабинет с сообщением об успешной смене пароля
        return redirect()->route('login')->with('status', 'Ваш пароль был успешно изменен!');
    }
}
