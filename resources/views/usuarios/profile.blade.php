@extends('layouts.base')

@section('titulo')<title>Perfil de usuario- Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Perfil de usuario", 'tituloModulo' => "Usuarios", 'rutaModulo' => URL::route('usuarios.index'), 'tituloSubmodulo' => "Perfil de usuario"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			<div>
				<div id="user-profile-1" class="user-profile row-fluid">
					<div class="span3 center">
						<div>
							<span class="profile-picture">
								@if($user->path == '')
								<img name="fotoActual" id="fotoActual" src="{{ asset('uploads/usuarios/unfile.png') }}" class="editable" alt="{{ $user->username }} Avatar" src="{{ asset('uploads/usuarios/unfile.jpg') }}" />
								@else
								<img name="fotoActual" id="fotoActual" src="{{ asset('uploads/usuarios/'.$user->path) }}" class="editable" alt="{{ $user->username }} Avatar" />
								@endif
							</span>
							<div class="space-4"></div>
							<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
								<div class="inline position-relative">
									<span class="white middle bigger-120">{{ $user->username }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="span9">
						<div class="profile-user-info profile-user-info-striped">
							<div class="profile-info-row">
								<div class="profile-info-name"> Nombre </div>
								<div class="profile-info-value">
									<span class="" id="name">{{ $user->name }}</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> Rol </div>

								<div class="profile-info-value">
									@if($user->rol == 1)
									<i class="icon-briefcase light-orange bigger-110"></i>
									<span class="" id="rol">Administrador</span>
									@elseif($user->rol == 0)
									<i class="icon-user light-orange bigger-110"></i>
									<span class="" id="rol">Usuario</span>
									@endif
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> Email </div>
								<div class="profile-info-value">
									<span class="" id="email">{{ $user->email }}</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop