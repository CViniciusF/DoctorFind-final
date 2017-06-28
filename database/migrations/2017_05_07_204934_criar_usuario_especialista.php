<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarUsuarioEspecialista extends Migration
{
  public function up()
  {
      Schema::create('usuarios_especialistas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('tel_consultorio', 20);
          $table->string('registro', 30);
          $table->string('apresentacao', 1500)->nullable()->default(null);
          $table->string('horario_atendimento', 50)->nullable()->default(null);
          $table->string('endereco_complemento')->nullable()->default(null);
          $table->string('endereco_numero')->nullable()->default(null);
          $table->string('endereco_rua')->nullable()->default(null);
          $table->string('endereco_cep')->nullable()->default(null);
          $table->string('endereco_bairro')->nullable()->default(null);
          $table->string('endereco_cidade')->nullable()->default(null);
          $table->string('endereco_uf')->nullable()->default(null);
          $table->integer('views_perfil')->nullable()->default(0);
          $table->boolean('completou_perfil')->nullable()->default(0);
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
      Schema::dropIfExists('usuarios_especialistas');
  }
}
