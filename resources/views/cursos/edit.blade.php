@extends('layouts.base')

@section('titulo')
<title>Editar curso - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar cursos", 'tituloModulo' => "Cursos", 'rutaModulo' => URL::route('cursos.index'), 'tituloSubmodulo' => "Editar cursos"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($curso, ['route' => ['cursos.update', $curso->id], "method" => "PUT", "name" => "cursoForm", "id" => "cursoForm", "class" => "form-horizontal"]) }}
				@include('cursos.form.CursoFormType', ["curso" => $curso])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('cursos.index'), 'valorData' => 0, 'idBoton' => 'cursoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop