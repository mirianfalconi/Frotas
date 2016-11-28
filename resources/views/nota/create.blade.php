@extends('layouts.nota')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Coordenador Transporte</div>
                <div class="panel-body">

              <form class="form-horizontal" role="form" method="POST" action="{{ url('/nota') }}">

              {{ csrf_field() }}
              @if(Session::has('flash_message'))
              <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>A nota foi cadastrada com sucesso!</em></div>
              @endif

                @include('nota.form')

@endsection
