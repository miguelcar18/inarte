@extends('layouts.base')

@section('titulo')
<title>Agregar evento - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar evento", 'tituloModulo' => "Eventos", 'rutaModulo' => URL::route('eventos.index'), 'tituloSubmodulo' => "Agregar evento"])
@stop

@section('javascripts')
	<script type="text/javascript">
		$(function() {
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
		});
	</script>
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'eventos.store', "name" => "eventoForm", "id" => "eventoForm", "class" => "form-horizontal"]) }}
				@include('eventos.form.EventoFormType')
				@if(isset($listado))
                @include('eventos.form.ListadoMatriculas', ['listado' => $listado])
                @else
                @include('eventos.form.ListadoMatriculas')
                @endif
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('eventos.index'), 'valorData' => 1, 'idBoton' => 'eventoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop