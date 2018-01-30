<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a href="#" class="brand">
				<small>
					<i class="icon-leaf"></i>
					Inarte
				</small>
			</a><!--/.brand-->
			<ul class="nav ace-nav pull-right">
				<li class="purple">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						@if(Auth::user()->path == '')
						<img class="nav-user-photo" src="{{ asset('uploads/usuarios/unfile.jpg') }}" alt="Foto de {{ Auth::user()->username }}" name="fotoNavbar" id="fotoNavbar" />
						@else
						<img class="nav-user-photo" src="{{ asset('uploads/usuarios/'.Auth::user()->path) }}" alt="Foto de {{ Auth::user()->username }}" name="fotoNavbar" id="fotoNavbar" />
						@endif
						<span class="user-info">
							<small>Bienvenido</small>
							{!! Auth::user()->name !!}
						</span>
						<i class="icon-caret-down"></i>
					</a>
					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
						<li>
							<a href="{{ URL::route('change_password') }}">
								<i class="icon-lock"></i>
								Cambiar contraseña
							</a>
						</li>
						<li>
							<a href="{{ URL::route('usuarios.show', Auth::user()->id) }}">
								<i class="icon-user"></i>
								Perfil
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="{{ URL::route('logout') }}">
								<i class="icon-off"></i>
								Salir
							</a>
						</li>
					</ul>
				</li>
			</ul><!--/.ace-nav-->
		</div><!--/.container-fluid-->
	</div><!--/.navbar-inner-->
</div>