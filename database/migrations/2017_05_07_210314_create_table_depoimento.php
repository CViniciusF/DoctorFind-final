<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDepoimento extends Migration
{
  public function up()
  {
      Schema::create('depoimentos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_especialista')->unsigned();
          $table->integer('id_paciente')->unsigned();
          $table->string('texto_depoimento', 1500);
          $table->boolean('autorizado')->nullable()->default(0);
          $table->boolean('lido')->nullable()->default(0);
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
      Schema::dropIfExists('depoimentos');
  }
}
