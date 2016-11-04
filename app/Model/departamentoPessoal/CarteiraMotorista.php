<?php



namespace App\Model\departamentoPessoal;

use Illuminate\Database\Eloquent\Model;

class CarteiraMotorista extends Model
{
  protected $table = 'carteira_motorista';


  protected $fillable = [
      'categoria',
  ];
}
