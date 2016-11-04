<?php

namespace App\Model\departamentoPessoal;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
  protected $table = 'cidade';


  protected $fillable = [
      'id', 'cidade',
  ];
}
