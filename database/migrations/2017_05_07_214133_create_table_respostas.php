<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRespostas extends Migration
  {
    public function up()
    {
      Schema::create('respostas', function (Blueprint $table) {
          $table->increments('id_resposta');
          $table->integer('id_pergunta')->unsigned();
          $table->string('texto_resposta', 1500);
          $table->foreign('id_pergunta')->references('id')->on('perguntas')->onDelete('cascade');
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
    Schema::dropIfExists('respostas');
  }
}
