@extends('layouts.base')

@section('titulo')
<title>Agregar evento privado - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar evento privado", 'tituloModulo' => "Eventos Privados", 'rutaModulo' => URL::route('eventosPrivados.index'), 'tituloSubmodulo' => "Agregar evento privado"])
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
			{{ Form::open(["method" => "post", "route" =>'eventosPrivados.store', "name" => "eventoPrivadoForm", "id" => "eventoPrivadoForm", "class" => "form-horizontal"]) }}
				@include('eventosPrivados.form.EventoFormType')
				@if(isset($listado))
                @include('eventosPrivados.form.ListadoMatriculas', ['listado' => $listado])
                @else
                @include('eventosPrivados.form.ListadoMatriculas')
                @endif
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('eventosPrivados.index'), 'valorData' => 1, 'idBoton' => 'eventoPrivadoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop