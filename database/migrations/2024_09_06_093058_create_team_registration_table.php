<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamRegistrationTable extends Migration
{
    public function up()
    {
        Schema::create('team_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('discord');
            $table->string('telegram');
            $table->date('birth_date');
            $table->string('city');
            $table->string('company');
            $table->string('branch');
            $table->string('team_name');
            $table->json('participants'); // Хранение участников команды в формате JSON
            $table->string('rank');
            $table->string('team_experience');
            $table->string('device');
            $table->string('match_times');
            $table->string('internet_connection');
            $table->string('special_requirements')->nullable();

            // Добавляем внешний ключ, который ссылается на таблицу games
            $table->unsignedBigInteger('game_id'); // ID игры
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_registrations');
    }
}
