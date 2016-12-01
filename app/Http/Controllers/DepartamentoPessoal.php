<?php

namespace App\Http\Controllers;

use App\Model\departamentoPessoal\Funcionario;
use App\Model\departamentoPessoal\CNH_Funcionario;
use App\Model\departamentoPessoal\CarteiraMotorista;
use App\Model\departamentoPessoal\Cidade;
use App\Model\departamentoPessoal\Cargo;
use App\Model\departamentoPessoal\CargoFuncionario;
use Gate;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Auth;
use Illuminate\Http\Request as Request;
use Response;
use App;
use Session;


class DepartamentoPessoal extends Controller
{
  public function __construct()
  {
      $this->middleware(['auth']);

      if (Auth::check()) {
        $cargos_funcionarios = CargoFuncionario::where('funcionarios_id', '=', Auth::user()->id )->first();
        $this->authorize('dp', $cargos_funcionarios->cargos_id);
   }

  }

  public function index(){

    $dp = DB::select('SELECT cnh.ct as categoria, funcionarios.id as id, nome, telefone, endereco, cnh, cidade, cargo
                								FROM cargos
                                JOIN cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                								JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                                LEFT JOIN
                                (SELECT GROUP_CONCAT(categoria SEPARATOR "") as ct, funcionarios_id
                									 FROM carteira_motorista
                										RIGHT JOIN cnh_funcionario ON (tipo_cnh_id = carteira_motorista.id)
                											group by cnh_funcionario.funcionarios_id) AS cnh
                                ON (cnh.funcionarios_id = funcionarios.id)
                              	JOIN cidade ON (funcionarios.cidade_id= cidade.id)');

    return view('dp.index')->with('dp', $dp);
  }

  public function show($id)
  {
    $dp = Funcionario::find($id);

    $dp->cidade_id = Cidade::select('cidade')->where('id', $dp->cidade_id)->first()->cidade;

    return view('dp.show')
      ->with('dp', $dp);
  }

  public function create()
  {

    $data = ['cidade'   => DB::table('cidade')->get(),
             'carteira' => DB::table('carteira_motorista')->get(),
             'cargo'    => DB::table('cargos')->get() ];


    return view('dp.create', $data);
  }

  public function destroy($id)
  {
    CargoFuncionario::where('funcionarios_id', $id)->delete();
    CNH_Funcionario::where('funcionarios_id', $id)->delete();
    Funcionario::find($id)->delete();


    Session::flash('message', 'O funcionário foi deletado!');
    return redirect('dp');
  }

  public function edit($id)
  {
    $dp = DB::select("SELECT cnh.ct as categoria, funcionarios.id as id, nome, telefone, endereco, cnh, cidade, cargo
                								FROM cargos
                                JOIN cargos_funcionarios ON (cargos.id = cargos_funcionarios.cargos_id)
                								JOIN funcionarios ON  (funcionarios.id=cargos_funcionarios.funcionarios_id)
                                LEFT JOIN
                                (SELECT GROUP_CONCAT(categoria SEPARATOR '') as ct, funcionarios_id
                									 FROM carteira_motorista
                										RIGHT JOIN cnh_funcionario ON (tipo_cnh_id = carteira_motorista.id)
                											group by cnh_funcionario.funcionarios_id) AS cnh
                                ON (cnh.funcionarios_id = funcionarios.id)
                              	JOIN cidade ON (funcionarios.cidade_id= cidade.id) where funcionarios.id = $id");

    var_dump($dp);
    return view('dp.edit')
      ->with('dp', $dp);
  }

  public function update($id, Request $data)
  {
    $this->validator($data->all())->validate();

    $dp =  Funcionario::find($id);
    $dp->nome        = $data['nome'];
    $dp->telefone    = $data['telefone'];
    $dp->password    = bcrypt($data['password']);
    $dp->endereco    = $data['endereco'];
    $dp->cidade_id   = $data['cidade_id'];
    $dp->cnh         = $data['cnh'];
    $dp->save();

//    if(!empty($data['categorias'])){
//        foreach ($data['categorias'] as $categoria) {

//            $cnh = CNH_Funcionario::where('funcionarios_id', $id);

//            $cnh->tipo_cnh_id = $data['categoria'];
//            $cnh->save();
//        }
//      }
      $cf = CargoFuncionario::where('funcionarios_id', $id);
      $cf->cargos_id = $data['cargos'];
      $cf->save();


      \Session::flash('message', 'Atualizada com Sucesso!');
      return redirect('dp');

  }





  public function storeCategoria(Request $request){


      Validator::make($request->all(), [
          'categoria' => 'required|max:1|unique:carteira_motorista',
      ])->validate();

      $categoria = CarteiraMotorista::create([
        'categoria' => $request->categoria,
      ]);

    return response()->json([ 'id' => $categoria->id, 'value' => $categoria->categoria]);

  }

  public function storeCidade(Request $request){


    Validator::make($request->all(), [
        'cidade' => 'required|max:45|unique:cidade',
    ])->validate();

      $cidade = Cidade::create([
        'cidade' => $request->cidade,
      ]);

      return response()->json([ 'cidade' => $cidade->cidade, 'id' => $cidade->id ]);
  }

  public function storeCargo(Request $request){


    Validator::make($request->all(), [
        'cargo' => 'required|max:45|unique:cargos',
    ])->validate();

      $cargo = Cargo::create([
        'cargo' => $request->cargo,
      ]);

      return response()->json([ 'cargo' => $cargo ]);
  }

  protected function validator(array $data)
  {
    $rules = array(
      'nome'     => 'required|max:255',
      'endereco' => 'required|max:240',
      'numero'   => 'required|numeric|max:9999999999',
      'telefone' => 'required|min:8|max:15',
      'password' => 'required|min:6|confirmed',
      'cargos'   => 'required');


      if(!empty($data['categorias']) || !empty($data['cnh'])){
        $rules['categorias'] = 'required|max:10|min:1';
        $rules['cnh'] = 'required|max:9999999999';
      }

      return Validator::make($data, $rules);


  }


  public function store(Request $request)
  {
      $this->validator($request->all())->validate();

      $this->register($request->all());

      return redirect('/dp');
  }


  protected function register(array $data)
  {
    $user =  Funcionario::create([
              'nome'     => $data['nome'],
              'telefone' => $data['telefone'],
              'password' => bcrypt($data['password']),
              'endereco' => $data['endereco'] . " " . $data['numero'],
              'cidade_id'   => $data['cidades'],
            ]);

      if(!empty($data['categorias']) && !empty($data['cnh'])){

        $user->cnh =  $data['cnh'];
        $user->save();

        foreach ($data['categorias'] as $categoria) {

            CNH_Funcionario::create([
              'funcionarios_id' => $user->id ,
              'tipo_cnh_id'    => $categoria,
            ]);
        }
      }
        CargoFuncionario::create([
          'funcionarios_id' => $user->id ,
          'cargos_id'       => $data['cargos'],
        ]);

        Session::flash('message', 'A matricula do novo usuário é ' . $user->id );
  }
}
