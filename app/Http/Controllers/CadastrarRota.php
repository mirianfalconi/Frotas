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
use App\Model\coordenadorTransporte\Veiculo;
use App\Model\coordenadorTransporte\RotasFuncionarios;
use App\Model\coordenadorTransporte\NotaRota;

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

    $motorista = DB::select("select horario_saida, rotas_funcionarios.id, motorista.nome as motorista, auxiliar.nome as auxiliar, placa, GROUP_CONCAT(nota.numero_nota SEPARATOR ', ') as nota from
                            (SELECT funcionarios.id, nome, cargo
                            	FROM cargos JOIN
                            		 cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                                     JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                            		 WHERE cargo like 'Motorista') as motorista ,
                            (SELECT funcionarios.id, nome, cargo
                            	FROM cargos JOIN
                            		 cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                                     JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                            		 WHERE cargo like 'Auxiliar de Transporte') as auxiliar,
                                     rotas_funcionarios,
                                     veiculos,
                                     notas_rotas,
                                     nota
                                     where rotas_funcionarios.motorista_id = motorista.id and
                            			   rotas_funcionarios.auxiliar_id = auxiliar.id and
                                     veiculos.id = rotas_funcionarios.veiculos_id and
                                     rotas_funcionarios.id = notas_rotas.rota_id and
                                     nota.id = notas_rotas.nota_id
                            		     group by rotas_funcionarios.id, motorista, auxiliar, placa");

    return view('rota.index')->with('motorista', $motorista);

  }

  private function selectFuncionarioByCargo($cargo){

    return "SELECT DISTINCT funcionarios.id, nome
          		FROM cargos
          			 JOIN cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id AND cargos.cargo LIKE '$cargo')
          			 JOIN funcionarios ON (funcionarios.id = cargos_funcionarios.funcionarios_id)
                       LEFT JOIN rotas_funcionarios ON
          				( motorista_id NOT IN
          				(SELECT DISTINCT motorista_id from rotas_funcionarios WHERE horario_chegada = NULL)
          				AND funcionarios.id = rotas_funcionarios.motorista_id)";
  }

  public function create()
  {
    $motorista_disponivel = DB::select($this->selectFuncionarioByCargo('Motorista'));
    $auxiliar_disponivel  = DB::select($this->selectFuncionarioByCargo('Auxiliar de Transporte'));

    $notas = DB::select("SELECT id, numero_nota, icms, peso, valor, quantidade, data_emissao
                        	FROM nota LEFT JOIN
                        		  notas_rotas
                              ON nota.id = notas_rotas.nota_id
                              where notas_rotas.nota_id is null");

    $placa = DB::select("SELECT veiculos.id, placa
                        	FROM veiculos
                        	WHERE veiculos.id not in
                            (select distinct(veiculos_id)
                        		from rotas_funcionarios where horario_chegada = NULL)");

    return view('rota.create', ['motorista' => $motorista_disponivel,
                                'auxiliar'  => $auxiliar_disponivel,
                                'notas'     => $notas,
                                'placa'     => $placa               ]);

  }

  public function storeVeiculo(Request $request){


    Validator::make($request->all(), [
        'placa' => 'required|max:8|unique:veiculos',
    ])->validate();

      $placa = Veiculo::create([
        'placa' => $request->placa,
      ]);

      return response()->json([ 'placa' => $placa ]);
  }

  public function store(Request $request)
  {

      $this->validator($request->all())->validate();
      $this->register($request->all());

      return redirect('/rota');
  }


  protected function validator(array $data)
  {
        $rules['motorista']     = 'numeric|required|max:99999999999|min:0';
        $rules['auxiliar']      = 'numeric|required|max:99999999999|min:0';
        $rules['placa']         = 'numeric|required|max:99999999999|min:0';
        $rules['nota_id']       = 'required|max:11|min:0|unique:notas_rotas';
        $rules['horario_saida'] = 'date|required';


      return Validator::make($data, $rules);

  }

  public function register(array $data){

    $date = new \DateTime($data['horario_saida']);

    $rf =  RotasFuncionarios::create([
              'motorista_id'     => $data['motorista'],
              'auxiliar_id'      => $data['auxiliar'],
              'veiculos_id'      => $data['placa'],
              'horario_saida'    => $date->format('Y/m/d'),
            ]);

      foreach ($data['nota_id'] as $nota) {

            NotaRota::create([
                  'rota_id'   => $rf->id ,
                  'nota_id'   => $nota,
       ]);
      }
      \Session::flash('flash_message', 'Rota Adicionada');

  }

  public function show($id)
  {
    $rota = DB::select("select horario_saida, rotas_funcionarios.id, motorista.nome as motorista, auxiliar.nome as auxiliar, placa, GROUP_CONCAT(nota.numero_nota SEPARATOR ', ') as nota from
                            (SELECT funcionarios.id, nome, cargo
                            	FROM cargos JOIN
                            		 cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                                     JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                            		 WHERE cargo like 'Motorista') as motorista ,
                            (SELECT funcionarios.id, nome, cargo
                            	FROM cargos JOIN
                            		 cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                                     JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                            		 WHERE cargo like 'Auxiliar de Transporte') as auxiliar,
                                     rotas_funcionarios,
                                     veiculos,
                                     notas_rotas,
                                     nota
                                     where rotas_funcionarios.motorista_id = motorista.id and
                            			   rotas_funcionarios.auxiliar_id = auxiliar.id and
                                     veiculos.id = rotas_funcionarios.veiculos_id and
                                     rotas_funcionarios.id = notas_rotas.rota_id and
                                     nota.id = notas_rotas.nota_id and
                                     rotas_funcionarios.id = $id
                            		     group by rotas_funcionarios.id, motorista, auxiliar, placa ");

    return view('rota.show')
      ->with('rota', $rota);
  }

    public function destroy($id)
    {
      $nota = NotaRota::where('nota_id', $id);
      $nota->delete();

      $rota = RotasFuncionarios::find($id);
      $rota->delete();

      Session::flash('message', 'A rota foi deletada!');
      return redirect('rota');
    }
}
