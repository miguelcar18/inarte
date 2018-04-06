@extends('layouts.base')

@section('titulo')
<title>Cambiar contraseña - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Cambiar contraseña", 'tituloModulo' => "Usuarios", 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => "Cambiar contraseña"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'postChangePassword', "name" => "changePasswordForm", "id" => "changePasswordForm", "class" => "form-horizontal"]) }}
				@include('usuarios.form.ChangePasswordFormType')
				@include('layouts.botonesFormularios', ['tituloBoton' => "Guardar", 'rutaCancelar' => URL::route('usuarios.index'), 'valorData' => 1, 'idBoton' => 'changePasswordSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop