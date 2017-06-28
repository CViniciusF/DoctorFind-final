<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioEspecialista extends Model
{
  protected $table = 'usuarios_especialistas';

  protected $fillable = [
      'id', 'tel_consultorio', 'registro', 'apresentacao', 'horario_atendimento', 'endereco_complemento', 'endereco_numero', 'endereco_rua', 'endereco_cep', 'endereco_bairro', 'endereco_cidade',
      'endereco_uf', 'is_valid', 'completou_perfil', 'indicacoes_orderby',    
  ];

}
