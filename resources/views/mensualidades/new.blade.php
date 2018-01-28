@extends('layouts.base')

@section('titulo')
<title>Agregar mensualidad - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar mensualidad", 'tituloModulo' => "Mensualidades", 'rutaModulo' => URL::route('mensualidades.index'), 'tituloSubmodulo' => "Agregar mensualidad"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'mensualidades.store', "name" => "mensualidadForm", "id" => "mensualidadForm", "class" => "form-horizontal"]) }}
				@include('mensualidades.form.MensualidadFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('mensualidades.index'), 'valorData' => 1, 'idBoton' => 'mensualidadSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop