<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioPaciente extends Model
{
  protected $table = 'usuarios_pacientes';

  protected $fillable = [
      'id', 'tel_fixo', 'tel_celular', 'data_nascimento','is_suspenso'
  ];

}
