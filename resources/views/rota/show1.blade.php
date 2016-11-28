@extends('layouts.rota')

@section('content')

<h1> Motorista {{ $motorista->id }}</h1>

	<div class="jumbotron">
		<p>

			<strong>ID:</strong> {{ $motorista->id }}<br>
			<strong>Motorista:</strong> {{ $motorista->nome }}<br>
      <strong>Cargo:</strong> {{ $motorista->cargo }}<br>
			<strong>CNH:</strong> {{ $motorista->categoria }} : {{ $motorista->cnh }}<br>


  	</p>
	</div>

</div>



@endsection
