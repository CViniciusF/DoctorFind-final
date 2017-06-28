<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
  protected $primaryKey = 'id_especialidade';
  protected $fillable = [
      'nome_especialidade'
  ];
}
