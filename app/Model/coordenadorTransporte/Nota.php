<?php

namespace App\Model\coordenadorTransporte;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
  protected $table = 'nota';


  protected $fillable = [
      'numero_nota', 'icms', 'peso', 'valor', 'quantidade', 'data_emissao',
  ];
}
