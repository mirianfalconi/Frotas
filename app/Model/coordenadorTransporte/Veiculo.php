<?php

namespace App\Model\coordenadorTransporte;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
  protected $table = 'veiculos';


  protected $fillable = [
      'placa'
  ];
}
