@extends('layouts.base')

@section('titulo')
<title>Editar mensualidades - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar mensualidad", 'tituloModulo' => "Mensualidades", 'rutaModulo' => URL::route('mensualidades.index'), 'tituloSubmodulo' => "Editar mensualidad"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($mensualidad, ['route' => ['mensualidades.update', $mensualidad->id], "method" => "PUT", "name" => "mensualidadForm", "id" => "mensualidadForm", "class" => "form-horizontal"]) }}
				@include('mensualidades.form.MensualidadFormType', ["mensualidad" => $mensualidad])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('mensualidades.index'), 'valorData' => 0, 'idBoton' => 'mensualidadSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop