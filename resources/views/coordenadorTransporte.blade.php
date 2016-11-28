@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="/nota"><button type="button" class="btn btn-default" aria-label="Left Align">Cadastrar Nota</button></a>


                  @can('rota', [$cargos_funcionarios, $numero_nota])
                      <a href="/rota"><button type="button" class="btn btn-default" aria-label="Left Align">Cadastrar Rota</button></a>
                  @endcan

                <!-- </div> -->
            </div>
    </div>
</div>





@endsection
