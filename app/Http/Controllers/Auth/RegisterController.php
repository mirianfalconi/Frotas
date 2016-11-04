<?php

namespace App\Http\Controllers\Auth;

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

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);

        if (Auth::check()) {
          $cargos_funcionarios = CargoFuncionario::where('funcionarios_id', '=', Auth::user()->id )->first();
          $this->authorize('dp', $cargos_funcionarios->cargos_id);

        }

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


  //    Validator::make($request->all(), [
  //        'cidade' => 'required|max:45|unique:cidade',
  //    ])->validate();

        $cidade = Cidade::create([
          'cidade' => $request->cidades,
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

        return response()->json([ 'cargo' => $cargo->cargo ]);
    }

    public function showRegistrationForm()
    {
      $data = ['cidade'   => DB::table('cidade')->get(),
               'carteira' => DB::table('carteira_motorista')->get(),
               'cargo'    => DB::table('cargos')->get() ];


      return view('auth.register', $data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome'     => 'required|max:255',
            'endereco' => 'required|max:240',
            'numero'   => 'required|numeric|max:9999999999',
            'telefone' => 'required|min:8|max:15',
            'password' => 'required|min:6|confirmed',
            'cnh'      => 'required|max:9999999999',
            'cargos'    => 'required',

        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect('/register');
    }


    protected function create(array $data)
    {
      $user =  Funcionario::create([
                'nome'     => $data['nome'],
                'telefone' => $data['telefone'],
                'password' => bcrypt($data['password']),
                'endereco' => $data['endereco'] . " " . $data['numero'],
                'cidade_id'   => $data['cidade'],
                'cnh'      => $data['cnh'],
              ]);

        if(!empty($data['categorias'])){
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

          \Session::flash('flash_message', $user->id);
    }
}
