
                  @if(Session::has('flash_message'))
                      <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> Sucesso! Cadastrado com a Matrícula {!! session('flash_message') !!}.</em></div>
                  @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/dp') }}">
                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="cargo" class="col-md-4 control-label">Setor</label>

                            <div id='sucessoCargo' class="col-md-6">
                              <select id='selectCargo' name="cargos" class="form-control" >
                                @foreach ($cargo as $funcionario)
                                    <option value="{{ $funcionario->id }}">{{ $funcionario->cargo }}</option>
                                @endforeach
                              </select>

                            </div>
                            <button id='plusCargo' type="button" class="btn btn-default" aria-label="Left Align">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </div>


                        <div id='criaCargo' class="form-group">
                            <label for="Cargo" class="col-md-4 control-label">Novo Setor</label>

                              <div id="Cargos" class="col-md-6">
                                  <input id="recebeCargo" type="text" class="form-control" name="Cargo" value="" >

                            </div>
                            <button id='sendCargo' type="text" class="btn btn-primary">
                                Ok
                            </button>
                        </div>



                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome" class="col-md-4 control-label">Nome</label>

                            <div class="col-md-6">
                                <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" autofocus>

                                @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                            <label for="telefone" class="col-md-4 control-label">Telefone</label>

                            <div class="col-md-6">
                                <input id="telefone" type="tel" class="form-control" name="telefone" value="{{ old('telefone') }}" >

                                @if ($errors->has('telefone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cnh') ? ' has-error' : '' }}">
                            <label for="cnh" class="col-md-4 control-label">CNH</label>

                            <div class="col-md-6">
                                <input id="cnh" type="text" class="form-control" name="cnh" value="{{ old('cnh') }}"  autofocus>

                                @if ($errors->has('cnh'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cnh') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categoria" class="col-md-4 control-label">Categoria</label>

                            <div id='categorias' class="col-md-6">
                              @foreach ($carteira as $funcionario)
                                  <input type="checkbox" name="categorias[]" value="{{ $funcionario->id }}"> {{ $funcionario->categoria }}
                              @endforeach

                            </div>
                            <button id="plusCategoria" type="button" class="btn btn-default" aria-label="Left Align">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </div>


                        <div id='categoriaDiv' class="form-group">
                            <label for="categoria" class="col-md-4 control-label">Nova Categoria</label>

                              <div class="col-md-6">
                                  <input id='categoria' type="text" class="form-control" name="categoria" value="" >
                             </div>
                            <button id='sendCategoria' type="text" class="btn btn-primary">
                                Ok
                            </button>
                        </div>



                        <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                            <label for="endereco" class="col-md-4 control-label">Endereço</label>

                            <div class="col-md-6">
                                <input id="endereco" type="text" class="form-control" name="endereco" value="{{ old('endereco') }}"  autofocus>

                                @if ($errors->has('endereco'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endereco') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                            <label for="numero" class="col-md-4 control-label">Número</label>

                            <div class="col-md-6">
                                <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}"  autofocus>

                                @if ($errors->has('numero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cidades" class="col-md-4 control-label">Cidade</label>

                            <div id='sucessoCidade' class="col-md-6">
                              <select id='selectCidade' name="cidades" class="form-control" >
                                @foreach ($cidade as $funcionario)

                                    <option value="{{ $funcionario->id }}">{{ $funcionario->cidade }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('cidades'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('cidades') }}</strong>
                                  </span>
                              @endif

                            </div>
                            <button id='plusCidade' type="button" class="btn btn-default" aria-label="Left Align">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </div>


                        <div id='criaCidade' class="form-group">
                            <label for="cidade" class="col-md-4 control-label">Nova Cidade</label>

                              <div id="cidade" class="col-md-6">
                                  <input id="recebeCidade" type="text" class="form-control" name="cidade" value="" >

                            </div>
                            <button id='sendCidade' type="text" class="btn btn-primary">
                                Ok
                            </button>
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirme a Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Ok
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
<script>

  $('#telefone').mask('(00) 0000-00009');
    $('#telefone').blur(function(event) {
      if($(this).val().length == 15){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
        $('#telefone').mask('(00) 00000-0009');
      } else {
        $('#telefone').mask('(00) 0000-00009');
      }
  });


  //////////////////////////////////////////////////////////////////////////////////////////////
  //
  //     ADICIONA Cargo
  //
  //////////////////////////////////////////////////////////////////////////////////////////////

  $('#criaCargo').css('display' , 'none');

  $('#plusCargo').click(function() {
    $('#criaCargo').css('display', 'block');
  });


  $('#sendCargo').click(function(e) {
    e.preventDefault();

    var $cargo = {'cargo' : $('#recebeCargo').val() };

    $.ajax({
        type: 'POST',
        cache: true,
        dataType: 'JSON',
        url: '/addCargo',
        data: $cargo,
        dataType: 'JSON',
        success: function (data) {

            $('#selectCargo').append('<option value="'+ data.cargo.id +'" selected>' + data.cargo.cargo + '</option>');
            $('#criaCargo').val('');
            $('#criaCargo').css('display' , 'none');

            $('#sucessoCargo').append('<p></p><span class="text-success"><strong>Cargo adicionado com Sucesso!</strong></span>');
            $('.text-success').delay( 8000 ).slideUp( 100 );
        },

        error: function(data){
          $('#Cargos').append('<span class="help-block"><strong> '+  data.responseJSON.cargo[0] +'</strong></span>');
          $('.help-block').delay( 8000 ).slideUp( 100 );
        }
      });
    });



  //////////////////////////////////////////////////////////////////////////////////////////////
  //
  //     ADICIONA CATEGORIA
  //
  //////////////////////////////////////////////////////////////////////////////////////////////

  $('#categoriaDiv').css('display' , 'none');

  $('#plusCategoria').click(function() {
    $('#categoriaDiv').css('display', 'block');
  });


  $('#sendCategoria').click(function(e) {
    e.preventDefault();

    var $categoria = {'categoria' : $('#categoria').val().toUpperCase() };

    $.ajax({
        type: 'POST',
        cache: true,
        dataType: 'JSON',
        url: '/addCnhCategoria',
        data: $categoria,
        dataType: 'JSON',
        success: function (data) {


            $('#categorias').append('<input type="checkbox" name="categoria[]" value="' + data.id + '" />' + data.value);
            $('#categoria').val('');
            $('#categoriaDiv').css('display' , 'none');

            $('#categorias').append('<p></p><span class="text-success"><strong>Categoria adicionada com Sucesso!</strong></span>');
            $('.text-success').delay( 8000 ).slideUp( 100 );

        },
        error : function (data) {

          $('#categorias').append('<span class="help-block"><strong> '+ data.responseJSON.categoria[0] +'</strong></span>');
          $('.help-block').delay( 8000 ).slideUp( 100 );

        }
      });
    });

    //////////////////////////////////////////////////////////////////////////////////////////////
    //
    //     ADICIONA CIDADE
    //
    //////////////////////////////////////////////////////////////////////////////////////////////

    $('#criaCidade').css('display' , 'none');

    $('#plusCidade').click(function() {
      $('#criaCidade').css('display', 'block');
    });


    $('#sendCidade').click(function(e) {
      e.preventDefault();

      var $cidade = {'cidade' : $('#recebeCidade').val() };

      $.ajax({
          type: 'POST',
          cache: true,
          dataType: 'JSON',
          url: '/addCidade',
          data: $cidade,
          dataType: 'JSON',
          success: function (data) {

              $('#selectCidade').append('<option value="'+ data.id +'" selected>' + data.cidade + '</option>');
              $('#criaCidade').val('');
              $('#criaCidade').css('display' , 'none');

              $('#sucessoCidade').append('<p></p><span class="text-success"><strong>Cidade adicionada com Sucesso!</strong></span>');
              $('.text-success').delay( 8000 ).slideUp( 100 );
          },

          error: function(data){
            $('#cidade').append('<span class="help-block"><strong> '+  data.responseJSON.cidade[0] +'</strong></span>');
            $('.help-block').delay( 8000 ).slideUp( 100 );
          }
        });
      });


</script>
