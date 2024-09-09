<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamRegistration extends Model
{
    protected $table = 'team_registrations';

    protected $fillable = [
        'email', 'name', 'surname', 'patronymic', 'discord', 'telegram',
        'birth_date', 'city', 'company', 'branch', 'team_name', 'participants',
        'rank', 'team_experience', 'device', 'match_times', 'internet_connection',
        'special_requirements', 'game_id' // Добавляем поле game_id
    ];

    // Указываем, что поле participants является JSON
    protected $casts = [
        'participants' => 'array',
    ];

    // Связь с моделью Game
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
    