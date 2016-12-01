@extends('layouts.dp')

@section('content')


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>Cargo</td>
			<td>Nome</td>
			<td>Telefone</td>
			<td>Endereço</td>
			<td>CNH</td>
		</tr>
	</thead>
	<tbody>

	@foreach($dp as $key => $value)


		<tr>
			<td>{{ $value->cargo }}</td>
			<td>{{ $value->nome }}</td>
			<td>{{ $value->telefone }}</td>
			<td>{{ $value->endereco }} <br> {{ $value->cidade }} </td>
			@if($value->categoria)
			<td>{{ $value->categoria }} : {{ $value->cnh }}</td>
			@else
			<td></td>
			@endif
      <td>

				{!! Form::open(array('url' => 'dp/' . $value->id, 'class' => 'pull-right')) !!}
					{!! Form::submit('Deletar Funcionario', array('class' => 'btn btn-warning')) !!}
          <a class="btn btn-small btn-success" href="{{ URL::to('dp/' . $value->id) }}">Mostrar Funcionário</a>
          	{!! Form::hidden('_method', 'DELETE') !!}
				{!! Form::close() !!}



			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@endsection
