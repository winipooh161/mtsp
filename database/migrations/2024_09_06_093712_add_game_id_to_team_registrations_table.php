<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGameIdToTeamRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('team_registrations', function (Blueprint $table) {
            // Добавляем поле game_id и внешний ключ, который ссылается на таблицу games
            $table->unsignedBigInteger('game_id')->nullable(); // game_id может быть null для существующих записей
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('team_registrations', function (Blueprint $table) {
            // Удаляем внешний ключ и столбец game_id при откате миграции
            $table->dropForeign(['game_id']);
            $table->dropColumn('game_id');
        });
    }
}
