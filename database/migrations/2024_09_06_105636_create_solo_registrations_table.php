<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoloRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('solo_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->string('email', 70);
            $table->string('name', 70);
            $table->string('surname', 70);
            $table->string('patronymic', 70);
            $table->string('discord', 70);
            $table->string('telegram', 70);
            $table->date('birth_date');
            $table->string('city', 50);
            $table->string('company', 70);
            $table->string('nickname', 50);
            $table->string('rank', 150);
            $table->string('time_game', 150);
            $table->string('device', 10);
            $table->string('match_times', 150);
            $table->string('internet_connection', 3);
            $table->string('special_requirements', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solo_registrations');
    }
}
