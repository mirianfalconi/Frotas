<?php

namespace App\Model\departamentoPessoal;

use Illuminate\Database\Eloquent\Model;

class CargoFuncionario extends Model
{
  protected $table = 'cargos_funcionarios';


  protected $fillable = [
      'cargos_id', 'funcionarios_id',
  ];

  public function funcionarios()
 {
     return $this->belongsTo('App\Model\departamentoPessoal\Funcionario', 'funcionarios_id', 'id');
 }
}
