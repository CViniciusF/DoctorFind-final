<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicacao extends Migration
{
  public function up()
  {
    Schema::create('indicacoes', function (Blueprint $table) {
        $table->increments('id_indicacao');
        $table->integer('id_especialista')->unsigned();
        $table->integer('id_paciente')->unsigned();
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
  Schema::dropIfExists('indicacoes');
}
}
