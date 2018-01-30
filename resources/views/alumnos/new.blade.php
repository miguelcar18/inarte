@extends('layouts.base')

@section('titulo')
<title>Agregaralumno - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar alumno", 'tituloModulo' => "Alumnos", 'rutaModulo' => URL::route('alumnos.index'), 'tituloSubmodulo' => "Agregar alumno"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'alumnos.store', "name" => "alumnoForm", "id" => "alumnoForm", "class" => "form-horizontal"]) }}
				@include('alumnos.form.AlumnoFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('alumnos.index'), 'valorData' => 1, 'idBoton' => 'alumnoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop