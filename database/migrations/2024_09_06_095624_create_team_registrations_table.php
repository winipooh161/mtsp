<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('team_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade'); // Привязка к игре
            $table->string('email', 70);
            $table->string('name', 70);
            $table->string('surname', 70);
            $table->string('patronymic', 70);
            $table->string('discord', 70);
            $table->string('telegram', 70);
            $table->date('birth_date');
            $table->string('city', 50);
            $table->string('company', 70);
            $table->string('branch');
            $table->string('team_name', 70);
            $table->json('participants'); // Список участников в формате JSON
            $table->string('rank', 150);
            $table->string('team_experience', 150);
            $table->string('device');
            $table->string('match_times', 150);
            $table->string('internet_connection');
            $table->string('special_requirements', 150)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_registrations');
    }
};
