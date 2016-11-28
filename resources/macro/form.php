<?php

Form::macro('padrao', function($boolError, $errors, $nome, $campo, $edit){

  if($boolError){
    return Form::erros($errors, $nome, $campo);
  }
  if(!empty($edit[$campo])){
    return Form::editar($nome, $campo, $edit[$campo]);
  }
    return Form::limpo($nome, $campo);



});

Form::macro('dump', function($problema){
  print_r($problema);

});

Form::macro('selectOptions', function($nome, $campo){



  return "<div class='form-group'>
      <label for='$campo' class='col-md-4 control-label'>$nome</label>

      <div id='$campo' class='col-md-6'>
        <select name='$campo' class='form-control' >
          @foreach($campo as $key => $value)
             <option value='{{" . $campo[$key] . " }}'>{{ ".$campo['$value']. " }}</option>
          @endforeach
        </select>
      </div>
      <button id='plus$nome' type='button' class='btn btn-default' aria-label='Left Align'>
        <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
      </button>
  </div>";

});

Form::macro('criar', function($boolError, $errors, $nome, $campo){

  if($boolError){
    return Form::erros($errors, $nome, $campo);
  }

    return Form::limpo($nome, $campo);


});

Form::macro('editar', function($nome, $campo, $edit)
{
    if($campo == 'data_emissao'){

      $t = strtotime($edit);
      $date =  date('d/m/yy',$t);

          return
          "<div class='form-group'>
            <label for='$campo' class='col-md-4 control-label'> $nome </label>

            <div class='col-md-6'>
              <input  type='text' class='form-control' name='$campo' value='$date' >
            </div>
          </div>";
    }

    return
    "<div class='form-group'>
      <label for='$campo' class='col-md-4 control-label'> $nome </label>

      <div class='col-md-6'>
        <input  type='text' class='form-control' name='$campo' value='$edit' >
      </div>
    </div>";


});

Form::macro('limpo', function($nome, $campo)
{
    return
    "<div class='form-group'>
      <label for='$campo' class='col-md-4 control-label'> $nome </label>

      <div class='col-md-6'>
        <input  type='text' class='form-control' name='$campo' value='' >
      </div>
    </div>";


});


Form::macro('erros', function($errors, $nome, $campo){
  return
  "<div class='form-group has-error'>
    <label for='$campo' class='col-md-4 control-label'> $nome </label>

    <div class='col-md-6'>
      <input  type='text' class='form-control' name='$campo' value='". old($campo) ."' >
          <span class='help-block'>
              <strong>$errors</strong>
          </span>
    </div>
  </div>";
});

Form::macro('fim', function(){

  return '<div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                Ok
              </button>
            </div>
          </div>';
});
?>
