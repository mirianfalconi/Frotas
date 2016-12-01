@extends('layouts.rota')

@section('content')


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>Horário de Saída</td>
			<td>Nome do Motorista</td>
				<td>Auxiliar de Transporte</td>
				<td>Placa do Veículo</td>
				<td>Lista de Notas</td>
		</tr>
	</thead>
	<tbody>
	@foreach($motorista as $key => $value)
		<tr>
			<td>{{ $value->horario_saida }}</td>
			<td>{{ $value->motorista }}</td>
			<td>{{ $value->auxiliar }}</td>
			<td>{{ $value->placa }}</td>
			<td>{{ $value->nota }}</td>
    <td>

				{!! Form::open(array('url' => 'rota/' . $value->id, 'class' => 'pull-right')) !!}
					{!! Form::submit('Deletar Rota', array('class' => 'btn btn-warning')) !!}
          <a class="btn btn-small btn-success" href="{{ URL::to('rota/' . $value->id) }}">Mostrar Rota</a>
          	{!! Form::hidden('_method', 'DELETE') !!}
				{!! Form::close() !!}



			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@endsection
