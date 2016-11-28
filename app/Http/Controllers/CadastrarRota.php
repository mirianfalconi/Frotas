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

class CadastrarRota extends Controller
{
  public function __construct()
  {
      $this->middleware(['auth']);

      $numero_nota = Nota::count();

      if (Auth::check()) {
        $cargos_funcionarios = CargoFuncionario::where('funcionarios_id', '=', Auth::user()->id )->first();
        $this->authorize('rota', [$cargos_funcionarios->cargos_id, $numero_nota]);
      }
  }

  public function index(){

    $motorista = DB::select("SELECT nome, cargo, cnh, ct as categoria
                            								FROM cargos JOIN
                                            cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                            								JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                                              LEFT JOIN
                                              (SELECT GROUP_CONCAT(categoria SEPARATOR '') as ct, funcionarios_id
                              									 FROM carteira_motorista
                              										RIGHT JOIN cnh_funcionario ON (tipo_cnh_id = carteira_motorista.id)
                            											group by cnh_funcionario.funcionarios_id) AS cnh
                                            ON (cnh.funcionarios_id = funcionarios.id)
                                          	JOIN cidade ON (funcionarios.cidade_id= cidade.id)

                                            WHERE cargo like 'Motorista'");



    return view('rota.index')->with('motorista', $motorista);

  }

  public function create()
  {
    $motorista = (DB::query('SELECT nome, cargo, cnh, ct as categoria
                            								FROM cargos JOIN
                                            cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                            								JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                                              LEFT JOIN
                                              (SELECT GROUP_CONCAT(categoria SEPARATOR "") as ct, funcionarios_id
                              									 FROM carteira_motorista
                              										RIGHT JOIN cnh_funcionario ON (tipo_cnh_id = carteira_motorista.id)
                            											group by cnh_funcionario.funcionarios_id) AS cnh
                                            ON (cnh.funcionarios_id = funcionarios.id)
                                          	JOIN cidade ON (funcionarios.cidade_id= cidade.id)

                                            WHERE cargo like "Motorista";')->toArray());


    return view('rota.create')->with('motorista', $motorista);

  }

}
