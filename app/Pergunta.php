<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
  protected $fillable = [
      'id_especialista', 'id_paciente', 'titulo_pergunta', 'texto_pergunta', 'data_pergunta', 'respondido'
  ];
}
