<?php

namespace App\Model\departamentoPessoal;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;


class Cargo extends EntrustRole
{
  protected $table = 'cargos';


  protected $fillable = [
      'cargo',
  ];
}
