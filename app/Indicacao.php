<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
  protected $table = 'indicacoes';
  protected $fillable = [
      'data_indicacao'
  ];
}
