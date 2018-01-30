@extends('layouts.base')

@section('titulo')
<title>Agregar sugerencia - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar sugerencia", 'tituloModulo' => "Sugerencias", 'rutaModulo' => URL::route('sugerencias.index'), 'tituloSubmodulo' => "Agregar sugerencia"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'sugerencias.store', "name" => "sugerenciaForm", "id" => "sugerenciaForm", "class" => "form-horizontal"]) }}
				@include('sugerencias.form.SugerenciaFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('sugerencias.index'), 'valorData' => 1, 'idBoton' => 'sugerenciaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop