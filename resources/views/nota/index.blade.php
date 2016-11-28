@extends('layouts.nota')

@section('content')


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Número da Nota</td>
			<td>ICMS</td>
			<td>Peso</td>
			<td>Valor</td>
			<td>Quantidade</td>
			<td>Data da Emissão</td>
		</tr>
	</thead>
	<tbody>
	@foreach($notas as $key => $value)
		<tr>
			<td>{{ $value->numero_nota }}</td>
			<td>{{ $value->icms }}</td>
			<td>{{ $value->peso }}</td>
			<td>{{ $value->valor }}</td>
			<td>{{ $value->quantidade }}</td>
			<td>{{ $value->data_emissao }}</td>

      <td>

				{!! Form::open(array('url' => 'nota/' . $value->id, 'class' => 'pull-right')) !!}
					{!! Form::submit('Deletar Nota', array('class' => 'btn btn-warning')) !!}
          <a class="btn btn-small btn-success" href="{{ URL::to('nota/' . $value->id) }}">Mostrar Nota</a>
          <a class="btn btn-small btn-info" href="{{ URL::to('nota/' . $value->id . '/edit') }}">Editar Nota</a>
          	{!! Form::hidden('_method', 'DELETE') !!}
				{!! Form::close() !!}



			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@endsection
