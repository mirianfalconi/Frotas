<?php

namespace App\Model\coordenadorTransporte;

use Illuminate\Database\Eloquent\Model;

class RotasFuncionarios extends Model
{
  protected $table = 'rotas_funcionarios';


  protected $fillable = [
      'veiculos_id', 'horario_saida', 'horario_chegada', 'auxiliar_id', 'motorista_id'
  ];
}
