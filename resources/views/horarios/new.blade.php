@extends('layouts.base')

@section('titulo')
<title>Agregar horario - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar horario", 'tituloModulo' => "Horarios", 'rutaModulo' => URL::route('horarios.index'), 'tituloSubmodulo' => "Agregar horario"])
@stop

@section('javascripts')
	
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'horarios.store', "name" => "horarioForm", "id" => "horarioForm", "class" => "form-horizontal"]) }}
				@include('horarios.form.HorarioFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('horarios.index'), 'valorData' => 1, 'idBoton' => 'horarioSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop