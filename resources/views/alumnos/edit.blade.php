@extends('layouts.base')

@section('titulo')
<title>Editar alumnos - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar alumno", 'tituloModulo' => "Alumnos", 'rutaModulo' => URL::route('alumnos.index'), 'tituloSubmodulo' => "Editar alumno"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($alumno, ['route' => ['alumnos.update', $alumno->id], "method" => "PUT", "name" => "alumnoForm", "id" => "alumnoForm", "class" => "form-horizontal"]) }}
				@include('alumnos.form.AlumnoFormType', ["alumno" => $alumno])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('alumnos.index'), 'valorData' => 0, 'idBoton' => 'alumnoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop