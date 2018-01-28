@extends('layouts.base')

@section('titulo')
<title>Editar usuario - FundaUdo</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar usuario", 'tituloModulo' => "Usuarios", 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => "Editar usuario"])
@stop

@section('javascripts')
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script type="text/javascript">
		$(".file-styled").uniform({
			wrapperClass: 'bg-teal-400',
			fileButtonHtml: '<i class="icon-googleplus5"></i>'
		});
	</script>
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($user, ['route' => ['usuarios.update', $user->id], "method" => "PUT", "name" => "usuarioForm", "id" => "usuarioForm", "class" => "form-horizontal"]) }}
				@include('usuarios.form.UsuarioFormType', ["user" => $user])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('usuarios.index'), 'valorData' => 0, 'idBoton' => 'usuarioSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop