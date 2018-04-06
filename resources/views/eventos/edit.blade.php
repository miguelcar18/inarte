@extends('layouts.base')

@section('titulo')
<title>Editar evento - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar evento", 'tituloModulo' => "Eventos", 'rutaModulo' => URL::route('eventos.index'), 'tituloSubmodulo' => "Editar evento"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($evento, ['route' => ['eventos.update', $evento->id], "method" => "PUT", "name" => "eventoForm", "id" => "eventoForm", "class" => "form-horizontal"]) }}
				@include('eventos.form.EventoFormType', ["evento" => $evento])
				@if(isset($listado))
                @include('eventos.form.ListadoMatriculas', ['listado' => $listado])
                @else
                @include('eventos.form.ListadoMatriculas')
                @endif
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('eventos.index'), 'valorData' => 0, 'idBoton' => 'eventoSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop

@section('javascripts')
	<script type="text/javascript">
		$(function() {
			$('.date-picker').datepicker().next().on(ace.click_event, function(){
				$(this).prev().focus();
			});
			$("input[name^='matriculaA']").each(function() {
				$("select#participantes").find("option[value='"+$(this).val()+"']").prop("disabled", true);
			});
		});
	</script>
@stop