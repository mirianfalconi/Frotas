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

class CadastrarNota extends Controller
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

    $notas = Nota::all();
    return view('nota.index')->with('notas', $notas);
  }

  public function create()
	{
		return view('nota.create');
	}

  public function destroy($id)
  {
    // delete
    $nota = Nota::find($id);
    $nota->delete();

    // redirect
    Session::flash('message', 'A nota foi deletada!');
    return redirect('nota');
  }

  public function show($id)
  {
    $nota = Nota::find($id);

    return view('nota.show')
      ->with('nota', $nota);
  }

  public function edit($id)
  {
    $nota = Nota::find($id);
    return view('nota.edit')->with('nota', $nota);
  }

  public function update($id, Request $data)
	{
		$this->validator($data->all())->validate();

    $date = new \DateTime($data['data_emissao']);

    $nota =  Nota::find($id);
    $nota->numero_nota  = $data['numero_nota'];
    $nota->icms         = $data['icms'];
    $nota->peso         = $data['peso'];
    $nota->valor        = $data['valor'];
    $nota->quantidade   = $data['quantidade'];
    $nota->data_emissao = $date->format('Y/m/d');
		$nota->save();

			\Session::flash('message', 'Atualizado com Sucesso!');
			return redirect('nota');

	}



  public function store(Request $request)
  {
      $this->validator($request->all())->validate();

      $this->register($request->all());

      return redirect('/nota');
  }


  protected function validator(array $data)
  {
      return Validator::make($data, [
          'numero_nota'     => 'required|min:0|max:45',
          'icms' => 'required|min:0|max:100|numeric',
          'peso'   => 'numeric|min:0',
          'valor' => 'required|numeric|min:0|max:9999999999',
          'quantidade' => 'required|min:1|max:9999999999|numeric',
          'data_emissao'      => 'date|required',
      ]);
  }

  public function register(array $data){

    $date = new \DateTime($data['data_emissao']);

    $nota =  Nota::create([
              'numero_nota'     => $data['numero_nota'],
              'icms' => $data['icms'],
              'peso' => $data['peso'],
              'valor' => $data['valor'],
              'quantidade'   => $data['quantidade'],
              'data_emissao'      => $date->format('Y/m/d'),
            ]);

        \Session::flash('flash_message', 'Nota Adicionada');

  }

}
