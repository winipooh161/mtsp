<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOfflineStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('user_offline_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->enum('offline', ['Да', 'Нет']);
            $table->timestamps();

            // Внешний ключ для связи с таблицей пользователей
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_offline_statuses');
    }
}
