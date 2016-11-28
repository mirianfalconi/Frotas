@if(isset($nota))

            {!! Form::padrao($errors->has('numero_nota'), $errors->first('numero_nota'), 'Número da Nota', 'numero_nota', $nota)  !!}

            {!! Form::padrao($errors->has('icms'), $errors->first('icms'), 'ICMS', 'icms', $nota)  !!}

            {!! Form::padrao($errors->has('peso'), $errors->first('peso'), 'Peso', 'peso', $nota)  !!}

            {!! Form::padrao($errors->has('valor'), $errors->first('valor'), 'Valor', 'valor', $nota)  !!}

            {!! Form::padrao($errors->has('quantidade'), $errors->first('quantidade'), 'Quantidade', 'quantidade', $nota)  !!}

            {!! Form::padrao($errors->has('data_emissao'), $errors->first('data_emissao'), 'Data de Emissão', 'data_emissao', $nota)  !!}

            {!! Form::fim() !!}

@else

            {!! Form::criar($errors->has('numero_nota'), $errors->first('numero_nota'), 'Número da Nota', 'numero_nota')  !!}

            {!! Form::criar($errors->has('icms'), $errors->first('icms'), 'ICMS', 'icms')  !!}

            {!! Form::criar($errors->has('peso'), $errors->first('peso'), 'Peso', 'peso')  !!}

            {!! Form::criar($errors->has('valor'), $errors->first('valor'), 'Valor', 'valor')  !!}

            {!! Form::criar($errors->has('quantidade'), $errors->first('quantidade'), 'Quantidade', 'quantidade')  !!}

            {!! Form::criar($errors->has('data_emissao'), $errors->first('data_emissao'), 'Data de Emissão', 'data_emissao')  !!}

            {!! Form::fim() !!}

@endif



          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

<script>

$("input[name*='data_emissao']").mask("99/99/9999", {placeholder: 'DD/MM/AAAA' });

</script>
