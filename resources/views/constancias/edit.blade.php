@extends('layouts.base')

@section('titulo')
<title>Editar constancia - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar constancia", 'tituloModulo' => "Constancias", 'rutaModulo' => URL::route('constancias.index'), 'tituloSubmodulo' => "Editar constancia"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($constancia, ['route' => ['constancias.update', $constancia->id], "method" => "PUT", "name" => "constanciaForm", "id" => "constanciaForm", "class" => "form-horizontal"]) }}
				@include('constancias.form.ConstanciaFormType', ["constancia" => $constancia])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('constancias.index'), 'valorData' => 0, 'idBoton' => 'constanciaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop