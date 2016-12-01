@extends('layouts.rota')

@section('content')

<h1>Rota {{ $rota[0]->id }}</h1>

	<div class="jumbotron">
		<p>


@foreach($rota as $key => $value)
			<strong>ID:</strong> {{ $value->id }}<br>
			<strong>Horário Saída:</strong> {{ $value->horario_saida }}<br>
      <strong>Motorista:</strong> {{ $value->motorista }}<br>
			<strong>Auxiliar de Transporte:</strong> {{ $value->auxiliar }}<br>

			<strong>Placa do Veículo:</strong> {{ $value->placa }}<br>
      <strong>Lista de Notas:</strong> {{ $value->nota }}<br>
	@endforeach


  	</p>
	</div>

</div>



@endsection
