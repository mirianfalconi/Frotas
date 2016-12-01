<div class="form-group{{ $errors->has('motorista') ? ' has-error' : '' }}">
    <label for="motorista" class="col-md-4 control-label">Escolha um motorista:</label>
    <div class="col-md-6">
      <select  name="motorista" class="form-control" >
        @foreach ($motorista as $funcionario)
            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
        @endforeach
      </select>
      @if ($errors->has('motorista'))
          <span class="help-block">
              <strong>{{ $errors->first('motorista') }}</strong>
          </span>
      @endif
</div>
</div>
<div class="form-group{{ $errors->has('auxiliar') ? ' has-error' : '' }}">
    <label for="auxiliar" class="col-md-4 control-label">Escolha um auxiliar de transporte:</label>
    <div class="col-md-6">
      <select  name="auxiliar" class="form-control" >
        @foreach ($auxiliar as $funcionario)
            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
        @endforeach
      </select>
      @if ($errors->has('auxiliar'))
          <span class="help-block">
              <strong>{{ $errors->first('auxiliar') }}</strong>
          </span>
      @endif
</div>
</div>

<div class="form-group{{ $errors->has('placa') ? ' has-error' : '' }}">
    <label for="placa" class="col-md-4 control-label">Escolha a Placa do Veículo:</label>
    <div class="col-md-6" id="sucessoVeiculo">
      <select  name="placa"  class="form-control" >
        @foreach ($placa as $funcionario)
            <option value="{{ $funcionario->id }}">{{ $funcionario->placa }}</option>
        @endforeach
      </select>
      @if ($errors->has('placa'))
          <span class="help-block">
              <strong>{{ $errors->first('placa') }}</strong>
          </span>
      @endif
</div>
<button id='plusVeiculo' type="button" class="btn btn-default" aria-label="Left Align">
  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
</button>
</div>


<div class="form-group{{ $errors->has('veiculo') ? ' has-error' : '' }}">
<div id='criaVeiculo' class="form-group">
    <label for="veiculo" class="col-md-4 control-label">Adicione um novo veículo:</label>
      <div id="veiculo" class="col-md-6">
          <input id="recebeVeiculo" type="text" class="form-control" name="veiculo" value="{{ old('veiculo') }}" >

          @if ($errors->has('veiculo'))
              <span class="help-block">
                  <strong>{{ $errors->first('veiculo') }}</strong>
              </span>
          @endif

    </div>

    <button id='sendVeiculo' type="text" class="btn btn-primary">
        Ok
    </button>
</div>
</div>
<div class="form-group{{ $errors->has('horario_saida') ? ' has-error' : '' }}">
  <label for='horario_saida' class='col-md-4 control-label'> Horário de Saída </label>

  <div class='col-md-6'>
    <input  type='text' class='form-control' name='horario_saida' value="{{ old('horario_saida') }}" >
    @if ($errors->has('horario_saida'))
        <span class="help-block">
            <strong>{{ $errors->first('horario_saida') }}</strong>
        </span>
    @endif
  </div>
</div>
<table class="table table-striped table-hover {{ $errors->has('nota_id') ? ' has-error' : '' }}">
	<thead>
    <h4>Escolha as notas:</h4>
    @if ($errors->has('nota_id'))
        <span class="help-block">
            <strong>{{ $errors->first('nota_id') }}</strong>
        </span>
    @endif
		<tr>
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
			<td id="info"><input value='{{ $value->id }}' name="nota_id[]"  type="checkbox">{{ $value->numero_nota }}</td>
			<td id="info">{{ $value->icms }}</td>
			<td id="info">{{ $value->peso }}</td>
			<td id="info">{{ $value->valor }}</td>
			<td id="info">{{ $value->quantidade }}</td>
			<td id="info">{{ $value->data_emissao }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
</div>
<div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
              Enviar
            </button>
          </div>
        </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

<style>

#info {
  cursor: pointer;
}

input[type=checkbox] {
  display: none;
}

</style>
<script>

$("input[name*='horario_saida']").mask("99/99/9999", {placeholder: 'DD/MM/AAAA' });

$('table tbody tr').click(function(event){
    if(!$(event.target).is(":checkbox"))
    {

        if($(this).find('[type="checkbox"]').is(':checked')){
          $(this).find('[type="checkbox"]').prop('checked',false)
          $(this).removeAttr('style');
        }
        else{
            $(this).find('[type="checkbox"]').prop('checked',true)
            $(this).css('background', '#ADD8E6');
    }
    }
});

//////////////////////////////////////////////////////////////////////////////////////////////
//
//     ADICIONA Placa
//
//////////////////////////////////////////////////////////////////////////////////////////////


$('#criaVeiculo').css('display' , 'none');

$('#plusVeiculo').click(function() {
  $('#criaVeiculo').css('display', 'block');
});

$('#sendVeiculo').click(function(e) {
  e.preventDefault();

  var $placa = {'placa' : $('#recebeVeiculo').val() };

  $.ajax({
      type: 'POST',
      cache: true,
      dataType: 'JSON',
      url: '/addVeiculo',
      data: $placa,
      dataType: 'JSON',
      success: function (data) {


          $('#tabelaVeiculo').append("<td id='info'><input value='" + data.placa.id + "' type='checkbox' />" + data.placa.placa + "</td>");
          $('#recebeVeiculo').val('');
          $('#criaVeiculo').css('display' , 'none');

          $('#sucessoVeiculo').append('<p></p><span class="text-success"><strong>Veiculo adicionado com Sucesso!</strong></span>');
          $('.text-success').delay( 8000 ).slideUp( 100 );
      },

      error: function(data){
        $('#veiculo').append('<span class="help-block"><strong> '+  data.responseJSON.placa[0] +'</strong></span>');
        $('.help-block').delay( 8000 ).slideUp( 100 );
      }
    });


  });

</script>
