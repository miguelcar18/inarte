@extends('layouts.base')

@section('titulo')
<title>Editar horario - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar horario", 'tituloModulo' => "Horarios", 'rutaModulo' => URL::route('horarios.index'), 'tituloSubmodulo' => "Editar horario"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($horario, ['route' => ['horarios.update', $horario->id], "method" => "PUT", "name" => "horarioForm", "id" => "horarioForm", "class" => "form-horizontal"]) }}
				@include('horarios.form.HorarioFormType', ["horario" => $horario])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('horarios.index'), 'valorData' => 0, 'idBoton' => 'horarioSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop