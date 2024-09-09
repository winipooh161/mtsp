<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\TeamRegistration;
use App\Models\SoloRegistration;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class RegController extends Controller
{
    public function registerGroup($id)
    {
        $game = Game::findOrFail($id); // Fetch the game by ID
        return view('register-group', compact('game'));
    }

    public function registerGroupCommand(Request $request, $id)
    {
        // Найти игру по ID
        $game = Game::findOrFail($id);

        // Преобразуем формат даты для каждого участника
        $participants = $request->input('participants', []);
        foreach ($participants as $key => $participant) {
            if (isset($participant['birth_date'])) {
                // Преобразуем формат DD/MM/YYYY в YYYY-MM-DD
                $birthDate = \DateTime::createFromFormat('d/m/Y', $participant['birth_date']);
                if ($birthDate) {
                    $participants[$key]['birth_date'] = $birthDate->format('Y-m-d');
                } else {
                    return redirect()->back()->withErrors(['participants' => "Invalid date format for participant $key."]);
                }
            }
        }

        // Преобразование основной даты рождения
        if ($request->has('birth_date')) {
            $birthDate = \DateTime::createFromFormat('d/m/Y', $request->birth_date);
            if ($birthDate) {
                $request->merge(['birth_date' => $birthDate->format('Y-m-d')]);
            } else {
                return redirect()->back()->withErrors(['birth_date' => 'Invalid date format.']);
            }
        }

        // Перезаписываем данные участников с преобразованной датой
        $request->merge(['participants' => $participants]);

        // Валидация данных
        $validated = $request->validate([
            'email' => 'required|email|max:70',
            'name' => 'required|string|max:70',
            'surname' => 'required|string|max:70',
            'patronymic' => 'required|string|max:70',
            'discord' => 'required|string|max:70',
            'telegram' => 'required|string|max:70',
            'nickname' => 'required|string|max:50',  // Валидация для никнейма
            'birth_date' => 'required|date',
            'city' => 'required|string|max:50',
            'company' => 'required|string|max:70',
            'branch' => 'required|string',
            'team_name' => 'required|string|max:70',
            'rank' => 'required|string|max:150',
            'team_experience' => 'required|string|max:150',
            'device' => 'required|string',
            'match_times' => 'required|string|max:150',
            'internet_connection' => 'required|string',
            'special_requirements' => 'nullable|string|max:150',
            'participants' => 'required|array|min:1',
            'participants.*.fio' => 'required|string|max:100',
            'participants.*.birth_date' => 'required|date',
            'participants.*.city' => 'required|string|max:50',
            'participants.*.email' => 'required|email|max:50',
            'participants.*.telegram' => 'required|string|max:50',
            'participants.*.discord' => 'required|string|max:50',
            'participants.*.nickname' => 'required|string|max:50',  // Валидация для никнейма участников
        ]);

        // Сохранение данных в базу
        $teamRegistration = TeamRegistration::create([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'discord' => $request->discord,
            'telegram' => $request->telegram,
            'nickname' => $request->nickname,  // Сохранение никнейма капитана
            'birth_date' => $request->birth_date,
            'city' => $request->city,
            'company' => $request->company,
            'branch' => $request->branch,
            'team_name' => $request->team_name,
            'participants' => json_encode($request->participants),  // Сериализация участников в JSON
            'rank' => $request->rank,
            'team_experience' => $request->team_experience,
            'device' => $request->device,
            'match_times' => $request->match_times,
            'internet_connection' => $request->internet_connection,
            'special_requirements' => $request->special_requirements,
            'game_id' => $game->id,  // Сохраняем ID игры
        ]);

        // Отправка email уведомления пользователю
        $to = $request->email;
        $subject = 'Регистрация команды на игру';
        $message = 'Здравствуйте, ' . $request->name . ' ' . $request->surname . "\n\n"
            . 'Вы успешно зарегистрировали команду "' . $request->team_name . '" для участия в игре "' . $game->title . '".'
            . "\nМы отправим вам всю необходимую информацию ближе к началу игры."
            . "\n\nЕсли это были не вы, пожалуйста, свяжитесь с нашей службой поддержки.";

        // Добавляем заголовки
        $headers = "From: info@mtscybercup.ru" . "\r\n" .
            "Reply-To: support@mtscybercup.ru" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        // Отправка письма через функцию mail
        mail($to, $subject, $message, $headers);

        // Возвращаем успешный ответ или перенаправление
        return redirect()->route('thanky', ['id' => $game->id]);
    }


    public function registerSolo($id)
    {
        $game = Game::findOrFail($id); // Fetch the game by ID
        return view('register-solo', compact('game'));
    }
    public function registerSoloCommand(Request $request, $id)
    {
        // Find the game by ID
        $game = Game::findOrFail($id);

        // Convert birth_date from DD/MM/YYYY to YYYY-MM-DD
        if ($request->has('birth_date')) {
            $birthDate = \DateTime::createFromFormat('d/m/Y', $request->birth_date);
            if ($birthDate) {
                $request->merge(['birth_date' => $birthDate->format('Y-m-d')]);
            } else {
                return redirect()->back()->withErrors(['birth_date' => 'Invalid date format.']);
            }
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'email' => 'required|email|max:70',
            'name' => 'required|string|max:70',
            'surname' => 'required|string|max:70',
            'patronymic' => 'required|string|max:70',
            'discord' => 'required|string|max:70',
            'telegram' => 'required|string|max:70',
            'birth_date' => 'required|date',
            'city' => 'required|string|max:50',
            'company' => 'required|string|max:70',
            'nickname' => 'required|string|max:50',
            'rank' => 'required|string|max:150',
            'time_game' => 'required|string|max:150',
            'device' => 'required|string',
            'match_times' => 'required|string|max:150',
            'internet_connection' => 'required|string',
            'special_requirements' => 'nullable|string|max:150',
        ]);

        // Save the registration to the database
        SoloRegistration::create([
            'game_id' => $game->id,
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'discord' => $request->discord,
            'telegram' => $request->telegram,
            'birth_date' => $request->birth_date,
            'city' => $request->city,
            'company' => $request->company,
            'nickname' => $request->nickname,
            'rank' => $request->rank,
            'time_game' => $request->time_game,
            'device' => $request->device,
            'match_times' => $request->match_times,
            'internet_connection' => $request->internet_connection,
            'special_requirements' => $request->special_requirements,
        ]);

        // Отправка email уведомления пользователю
        $to = $request->email;
        $subject = 'Регистрация на игру';
        $message = 'Здравствуйте, ' . $request->name . ' ' . $request->surname . "\n\n"
            . 'Вы успешно зарегистрированны  для участия в игре "' . $game->title . '".'
            . "\nМы отправим вам всю необходимую информацию ближе к началу игры."
            . "\n\nЕсли это были не вы, пожалуйста, свяжитесь с нашей службой поддержки.";

        // Добавляем заголовки
        $headers = "From: info@mtscybercup.ru" . "\r\n" .
            "Reply-To: support@mtscybercup.ru" . "\r\n" .
            "X-Mailer: PHP/" . phpversion();

        // Отправка письма через функцию mail
        mail($to, $subject, $message, $headers);

        // Redirect to a thank you page
        return redirect()->route('thanky', ['id' => $game->id])->with('success', 'Registration completed successfully.');
    }



    public function thanky($id)
    {
        $game = Game::findOrFail($id); // Fetch the game by ID
        return view('thanky', compact('game'));
    }
}
