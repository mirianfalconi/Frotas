@extends('layouts.dp')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Departamento Pessoal</div>
                <div class="panel-body">


              {!! Form::open(array('action' => array('DepartamentoPessoal@update', $dp[0]->id), 'method' => 'PUT')) !!}
              {{ csrf_field() }}
              @if(Session::has('flash_message'))
              <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>O funcionário foi atualizado com sucesso!</em></div>
              @endif

                @include('dp.formEdit')

@endsection
