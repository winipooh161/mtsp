<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoloRegistration extends Model
{
    use HasFactory;

    protected $table = 'solo_registrations';

    protected $fillable = [
        'game_id',
        'email',
        'name',
        'surname',
        'patronymic',
        'discord',
        'telegram',
        'birth_date',
        'city',
        'company',
        'nickname',
        'rank',
        'time_game',
        'device',
        'match_times',
        'internet_connection',
        'special_requirements',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
