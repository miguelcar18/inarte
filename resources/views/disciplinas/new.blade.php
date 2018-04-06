@extends('layouts.base')

@section('titulo')
<title>Agregar disciplina - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar disciplina", 'tituloModulo' => "Disciplinas", 'rutaModulo' => URL::route('disciplinas.index'), 'tituloSubmodulo' => "Agregar disciplina"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'disciplinas.store', "name" => "disciplinaForm", "id" => "disciplinaForm", "class" => "form-horizontal"]) }}
				@include('disciplinas.form.DisciplinaFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('disciplinas.index'), 'valorData' => 1, 'idBoton' => 'disciplinaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop