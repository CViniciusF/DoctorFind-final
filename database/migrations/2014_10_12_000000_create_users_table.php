<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('password', 60);
            $table->string('gender')->default('genero não especificado');
            $table->string('avatar')->default('foto não encontrada');
            $table->string('provider')->default('registrado pelo site');
            $table->string('provider_id')->default('registrado pelo site');
            $table->integer('indicacoes_orderby')->nullable()->default(0);
            $table->boolean('is_admin')->nullable()->default(0);
            $table->boolean('is_suspenso')->nullable()->default(0);
            $table->boolean('is_valid')->nullable()->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
