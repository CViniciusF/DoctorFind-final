<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidades extends Migration
{
  public function up()
  {
      Schema::create('especialidades', function (Blueprint $table) {
          $table->increments('id_especialidade');
          $table->string('nome_especialidade');
          $table->timestamps();
      });

      Schema::create('pivot_usuario_especialidade', function (Blueprint $table) {
          $table->increments('id_p_esp');
          $table->integer('id_pivot_usuario')->unsigned();
          $table->integer('id_pivot_especialidade')->unsigned();
          $table->foreign('id_pivot_especialidade')->references('id_especialidade')->on('especialidades')->onDelete('cascade');
          $table->foreign('id_pivot_usuario')->references('id')->on('usuarios_especialistas')->onDelete('cascade');
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
      Schema::dropIfExists('especialidades');
      Schema::dropIfExists('pivot_usuario_especialidade');
  }
}
