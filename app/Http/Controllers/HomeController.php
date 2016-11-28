<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Model\departamentoPessoal\CargoFuncionario;
use App\Model\departamentoPessoal\Funcionario;
use Gate;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

      $this->middleware(['auth']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $cargos_funcionarios = CargoFuncionario::where('funcionarios_id', '=', Auth::user()->id )->first();

        if( $cargos_funcionarios->cargos_id == 1){

            return redirect('/dp');
        }

        if( $cargos_funcionarios->cargos_id == 2){

            return redirect('/coordenador_transporte');
        }


        return view('home');
    }
}
