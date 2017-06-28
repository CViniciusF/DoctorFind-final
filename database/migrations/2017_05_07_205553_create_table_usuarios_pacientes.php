<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuariosPacientes extends Migration
{
  public function up()
  {
      Schema::create('usuarios_pacientes', function (Blueprint $table) {
          $table->increments('id');
          $table->string('tel_fixo', 20)->nullable();
          $table->string('tel_celular', 20)->nullable();
          $table->string('data_nascimento', 50);
          $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
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
      Schema::dropIfExists('usuarios_pacientes');
  }
}
