@extends('layouts.base')

@section('titulo')Perfil - FundaUdo@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Perfil de usuario", 'tituloModulo' => "Usuarios", 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => "Perfil de usuario"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-lg-offset-4 col-md-offset-3">
					<div class="thumbnail">
						<div class="thumb thumb-rounded">
							@if($user->path == '')
							<img name="fotoActual" id="fotoActual" src="{{ asset('uploads/usuarios/unfile.jpg') }}" class="img-responsive" alt="" width="150px" height="auto">
							@else
							<img name="fotoActual" id="fotoActual" src="{{ asset('uploads/usuarios/'.$user->path) }}" class="img-responsive" alt="" width="150px" height="auto">
							@endif
						</div>
						<div class="caption text-center">
							<h4 class="text-semibold no-margin">{{ $user->name }}</h4>
							<h4 class="text-semibold no-margin">
								@if($user->rol == 1)
								Administrador
								@elseif($user->rol == 0)
								Usuario
								@endif
							</h4>
							<h4 class="text-semibold no-margin">{{ $user->username }}</h4>
							<h4 class="text-semibold no-margin">{{ $user->email }}</h4>
							<h4 class="text-semibold no-margin">{{ $user->details }}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop