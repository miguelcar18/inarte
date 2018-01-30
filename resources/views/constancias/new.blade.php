@extends('layouts.base')

@section('titulo')
<title>Agregar constancia - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar constancia", 'tituloModulo' => "Constancias", 'rutaModulo' => URL::route('constancias.index'), 'tituloSubmodulo' => "Agregar constancia"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'constancias.store', "name" => "constanciaForm", "id" => "constanciaForm", "class" => "form-horizontal"]) }}
				@include('constancias.form.ConstanciaFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('constancias.index'), 'valorData' => 1, 'idBoton' => 'constanciaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop