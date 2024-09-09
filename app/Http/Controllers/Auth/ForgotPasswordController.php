<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Убедитесь, что этот шаблон существует
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Валидация email
        $request->validate(['email' => 'required|email']);

        // Проверка наличия пользователя с данным email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Генерация токена для сброса пароля
            $token = Password::createToken($user);

            // Сохранение токена в таблицу password_resets
            DB::table('password_resets')->updateOrInsert(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => Hash::make($token), // Токен сохраняется в зашифрованном виде
                    'created_at' => now(),
                ]
            );

            // Создание ссылки для сброса пароля
            $resetLink = url('password/reset', $token) . '?email=' . urlencode($request->email);

            // Формирование письма
            $to = $request->input('email');
            $subject = "Восстановление пароля на сайте mts.kwol.ru";
            $message = "Для восстановления пароля перейдите по следующей ссылке: " . $resetLink;
            $headers = "From: info@mtscybercup.ru";

            // Отправка письма с использованием стандартной PHP-функции mail()
            if (mail($to, $subject, $message, $headers)) {
                return back()->with('status', 'Ссылка для восстановления пароля отправлена на ваш email!');
            } else {
                return back()->withErrors(['email' => 'Ошибка при отправке сообщения.']);
            }
        } else {
            // Если пользователь не найден
            return back()->withErrors(['email' => 'Пользователь с таким email не найден.']);
        }
    }
}
