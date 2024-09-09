<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    /**
     * Отправка email пользователю после успешной авторизации.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function sendLoginEmail($user)
    {
        $to = $user->email;
        $subject = 'Вы вошли в аккаунт';
        $message = 'Здравствуйте, ' . $user->name . "\n\n"
            . 'Мы заметили, что вы недавно вошли в свой аккаунт. '
            . 'Если это были не вы, пожалуйста, смените пароль или обратитесь в службу поддержки.';

        // Добавляем заголовки
        $headers = "From: info@mtscybercup.ru" . "\r\n" .
            "Reply-To: support@mtscybercup.ru" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        // Отправка письма через функцию mail
        mail($to, $subject, $message, $headers);
    }
}
