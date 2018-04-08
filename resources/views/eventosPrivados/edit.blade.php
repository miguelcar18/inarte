@extends('layouts.base')

@section('titulo')
<title>Editar evento privado - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar evento privado", 'tituloModulo' => "Eventos Privados", 'rutaModulo' => URL::route('eventos.index'), 'tituloSubmodulo' => "Editar evento privado"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($evento, ['route' => ['eventosPrivados.update', $evento->id], "method" => "PUT", "name" => "eventoPrivadoForm", "id" => "eventoPrivadoForm", "class" => "form-horizontal"]) }}
				@include('eventosPrivados.form.EventoFormType', ["evento" => $evento])
				@if(isset($listado))
                @include('eventosPrivados.form.ListadoMatriculas', ['listado' => $listado])
                @else
                @include('eventosPrivados.form.ListadoMatriculas')
                @endif
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('eventosPrivados.index'), 'valorData' => 0, 'idBoton' => 'eventoPrivadoSubmit'])
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