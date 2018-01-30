@extends('layouts.base')

@section('titulo')
<title>Editar sugerencia - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar sugerencia", 'tituloModulo' => "Sugerencias", 'rutaModulo' => URL::route('sugerencias.index'), 'tituloSubmodulo' => "Editar sugerencia"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($sugerencia, ['route' => ['sugerencias.update', $sugerencia->id], "method" => "PUT", "name" => "sugerenciaForm", "id" => "sugerenciaForm", "class" => "form-horizontal"]) }}
				@include('sugerencias.form.SugerenciaFormType', ["sugerencia" => $sugerencia])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('sugerencias.index'), 'valorData' => 0, 'idBoton' => 'sugerenciaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop