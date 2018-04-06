@extends('layouts.base')

@section('titulo')
<title>Agregar matricula - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Agregar matricula", 'tituloModulo' => "Matriculas", 'rutaModulo' => URL::route('matriculas.index'), 'tituloSubmodulo' => "Agregar matricula"])
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
			{{ Form::open(["method" => "post", "route" =>'matriculas.store', "name" => "matriculaForm", "id" => "matriculaForm", "class" => "form-horizontal"]) }}
				@include('matriculas.form.MatriculaFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('matriculas.index'), 'valorData' => 1, 'idBoton' => 'matriculaSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop