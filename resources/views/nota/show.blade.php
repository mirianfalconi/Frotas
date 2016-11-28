@extends('layouts.nota')

@section('content')

<h1>Nota {{ $nota->numero_nota }}</h1>

	<div class="jumbotron">
		<p>

			<strong>ID:</strong> {{ $nota->id }}<br>
			<strong>Número da Nota:</strong> {{ $nota->numero_nota }}<br>
      <strong>ICMS:</strong> {{ $nota->icms }}<br>
			<strong>Peso:</strong> {{ $nota->peso }}<br>

			<strong>Valor:</strong> {{ $nota->valor }}<br>
      <strong>Quantidade:</strong> {{ $nota->quantidade }}<br>
			<strong>Data de Emissão:</strong> {{ $nota->data_emissao }}<br>



  	</p>
	</div>

</div>



@endsection
