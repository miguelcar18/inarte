@extends('layouts.base')

@section('titulo')
<title>Editar matricula - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar matricula", 'tituloModulo' => "Matriculas", 'rutaModulo' => URL::route('matriculas.index'), 'tituloSubmodulo' => "Editar matricula"])
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
			{{ Form::model($matricula, ['route' => ['matriculas.update', $matricula->id], "method" => "PUT", "name" => "matriculaForm", "id" => "matriculaForm", "class" => "form-horizontal"]) }}
				@include('matriculas.form.MatriculaFormType', ["matricula" => $matricula])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('matriculas.index'), 'valorData' => 0, 'idBoton' => 'matriculaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop