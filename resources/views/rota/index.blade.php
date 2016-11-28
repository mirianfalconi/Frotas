@extends('layouts.rota')

@section('content')


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Número da Rota</td>
			<td>ICMS</td>
			<td>Peso</td>
			<td>Valor</td>
			<td>Quantidade</td>
			<td>Data da Emissão</td>
		</tr>
	</thead>
	<tbody>
	@foreach($motorista as $key => $value)
		<tr>


      <td>

				{!! Form::open(array('url' => 'rota/' . $value->id, 'class' => 'pull-right')) !!}
					{!! Form::submit('Deletar Rota', array('class' => 'btn btn-warning')) !!}
          <a class="btn btn-small btn-success" href="{{ URL::to('rota/' . $value->id) }}">Mostrar Rota</a>
          <a class="btn btn-small btn-success" href="{{ URL::to('motorista/' . $value->id) }}">Mostrar Rota</a>
          <a class="btn btn-small btn-info" href="{{ URL::to('rota/' . $value->id . '/edit') }}">Editar Rota</a>
          	{!! Form::hidden('_method', 'DELETE') !!}
				{!! Form::close() !!}



			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
@endsection
