@extends('layouts.base')

@section('titulo')
<title>Editar disciplina - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar disciplina", 'tituloModulo' => "Disciplinas", 'rutaModulo' => URL::route('disciplinas.index'), 'tituloSubmodulo' => "Editar disciplina"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($disciplina, ['route' => ['disciplinas.update', $disciplina->id], "method" => "PUT", "name" => "disciplinaForm", "id" => "disciplinaForm", "class" => "form-horizontal"]) }}
				@include('disciplinas.form.DisciplinaFormType', ["disciplina" => $disciplina])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('disciplinas.index'), 'valorData' => 0, 'idBoton' => 'disciplinaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop