@extends('layouts.base')

@section('titulo')
<title>Agregar curso - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar curso", 'tituloModulo' => "Cursos", 'rutaModulo' => URL::route('cursos.index'), 'tituloSubmodulo' => "Agregar curso"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'cursos.store', "name" => "cursoForm", "id" => "cursoForm", "class" => "form-horizontal"]) }}
				@include('cursos.form.CursoFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('cursos.index'), 'valorData' => 1, 'idBoton' => 'cursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop