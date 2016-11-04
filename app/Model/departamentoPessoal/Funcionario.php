<?php

namespace App\Model\departamentoPessoal;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Funcionario extends Authenticatable
{

  use Notifiable;

    protected $table = 'funcionarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'telefone', 'password', 'endereco', 'cidade_id', 'cnh',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cargos_funcionarios()
   {
       return $this->belongsTo('App\Model\departamentoPessoal\CargoFuncionario', 'id', 'funcionarios_id');
   }
}
