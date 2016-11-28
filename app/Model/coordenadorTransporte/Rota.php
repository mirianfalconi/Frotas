<?php

namespace App\Model\coordenadorTransporte;

use Illuminate\Database\Eloquent\Model;

class Rota extends Model
{
  protected $table = 'rota';


  protected $fillable = [
      'destino',
  ];
}
