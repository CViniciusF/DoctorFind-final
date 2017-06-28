<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsPerfilTelefone extends Migration
{
  public function up()
  {
    // Schema::create('views_perfil', function (Blueprint $table) {
    //     $table->increments('id_views_perfil');
    //     $table->integer('id_especialista')->unsigned();
    //     $table->integer('id_paciente')->unsigned();
    //     $table->foreign('id_especialista')->references('id')->on('usuarios_especialistas')->onDelete('cascade');
    //     $table->foreign('id_paciente')->references('id')->on('usuarios_pacientes')->onDelete('cascade');
    //     $table->timestamps();
    // });
    Schema::create('views_telefone', function (Blueprint $table) {
      $table->increments('id_views_telefone');
      $table->integer('id_especialista')->unsigned();
      $table->integer('id_paciente')->unsigned();
      $table->integer('lido')->nullable()->default(0);
      $table->foreign('id_especialista')->references('id')->on('usuarios_especialistas')->onDelete('cascade');
      $table->foreign('id_paciente')->references('id')->on('usuarios_pacientes')->onDelete('cascade');

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
    Schema::dropIfExists('views_telefone');
    Schema::dropIfExists('views_perfil');
  }
}
