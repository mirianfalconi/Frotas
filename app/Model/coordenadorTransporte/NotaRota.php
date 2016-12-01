<?php

namespace App\Model\coordenadorTransporte;

use Illuminate\Database\Eloquent\Model;

class NotaRota extends Model
{
  protected $table = 'notas_rotas';


  protected $fillable = [
    'nota_id', 'rota_id'
  ];
}
