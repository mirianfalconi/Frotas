@extends('layouts.dp')

@section('content')

<h1>Funcionário {{ $dp->numero_dp }}</h1>

  <div class="jumbotron">
		<p>

			<strong>ID:</strong> {{ $dp->id }}<br>
			<strong>Nome:</strong> {{ $dp->nome }}<br>
      <strong>Telefone:</strong> {{ $dp->telefone }}<br>
			<strong>Endereço:</strong> {{ $dp->endereco }}<br>

			<strong>Cidade:</strong> {{ $dp->cidade_id }}<br>
      <strong>CNH:</strong> {{ $dp->cnh }}<br>



  	</p>
	</div>

</div>



@endsection
