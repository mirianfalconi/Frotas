<?php

namespace App\Model\departamentoPessoal;

use Illuminate\Database\Eloquent\Model;

class CNH_Funcionario extends Model
{
  protected $table = 'cnh_funcionario';


  protected $fillable = [
      'funcionarios_id', 'tipo_cnh_id',
  ];
}
