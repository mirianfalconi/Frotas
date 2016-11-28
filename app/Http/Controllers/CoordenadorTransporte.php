<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Gate;
use Validator;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Response;
use App;
use Session;
use App\Model\departamentoPessoal\CargoFuncionario;
use App\Model\coordenadorTransporte\Nota;

class CoordenadorTransporte extends Controller
{

      public function __construct()
      {
          $this->middleware(['auth']);

          if (Auth::check()) {
            $cargos_funcionarios = CargoFuncionario::where('funcionarios_id', '=', Auth::user()->id )->first();
            $this->authorize('ct', $cargos_funcionarios->cargos_id);

          }
      }

      public function index(){

        $cargos_funcionarios = CargoFuncionario::where('funcionarios_id', '=', Auth::user()->id )->first();
        $numero_nota = Nota::count();
        return view('coordenadorTransporte', ['cargos_funcionarios' => $cargos_funcionarios->cargos_id, 'numero_nota' => $numero_nota]);

      }


}
