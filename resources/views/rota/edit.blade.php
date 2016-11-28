@extends('layouts.rota')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Coordenador Transporte</div>
                <div class="panel-body">


              {!! Form::open(array('action' => array('CadastrarRota@update', $rota->id), 'method' => 'PUT')) !!}
              {{ csrf_field() }}
              @if(Session::has('flash_message'))
              <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>A rota foi atualizada com sucesso!</em></div>
              @endif

                @include('rota.form')

@endsection
