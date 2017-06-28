<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depoimento extends Model
{
  protected $fillable = [
      'id_especialista', 'id_paciente', 'texto_depoimento', 'autorizado',
  ];
}
