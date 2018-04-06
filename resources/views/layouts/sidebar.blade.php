<div class="sidebar fixed" id="sidebar">
	<ul class="nav nav-list">
		<li @if(Route::getCurrentRoute()->getName() == 'principal') class="active"  @else class="" @endif >
			<a href="{{ URL::route('principal') }}">
				<i class="icon-dashboard"></i>
				<span class="menu-text"> Inicio </span>
			</a>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'disciplinas.index' or Route::getCurrentRoute()->getName() == 'disciplinas.show' or Route::getCurrentRoute()->getName() == 'disciplinas.edit' or Route::getCurrentRoute()->getName() == 'disciplinas.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-star"></i>
				<span class="menu-text"> Disciplinas</span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'disciplinas.index' or 
					Route::getCurrentRoute()->getName() == 'disciplinas.show' or 
					Route::getCurrentRoute()->getName() == 'disciplinas.edit') class="active" @endif>
					<a href="{{ URL::route('disciplinas.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'disciplinas.create') class="active" @endif>
					<a href="{{ URL::route('disciplinas.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'matriculas.index' or Route::getCurrentRoute()->getName() == 'matriculas.show' or Route::getCurrentRoute()->getName() == 'matriculas.edit' or Route::getCurrentRoute()->getName() == 'matriculas.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-maxcdn"></i>
				<span class="menu-text"> Matricula</span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'matriculas.index' or 
					Route::getCurrentRoute()->getName() == 'matriculas.show' or 
					Route::getCurrentRoute()->getName() == 'matriculas.edit') class="active" @endif>
					<a href="{{ URL::route('matriculas.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'matriculas.create') class="active" @endif>
					<a href="{{ URL::route('matriculas.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'personal.index' or Route::getCurrentRoute()->getName() == 'personal.show' or Route::getCurrentRoute()->getName() == 'personal.edit' or Route::getCurrentRoute()->getName() == 'personal.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-briefcase"></i>
				<span class="menu-text"> Personal </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'personal.index' or 
					Route::getCurrentRoute()->getName() == 'personal.show' or 
					Route::getCurrentRoute()->getName() == 'personal.edit') class="active" @endif>
					<a href="{{ URL::route('personal.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'personal.create') class="active" @endif>
					<a href="{{ URL::route('personal.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'mensualidades.index' or Route::getCurrentRoute()->getName() == 'mensualidades.show' or Route::getCurrentRoute()->getName() == 'mensualidades.edit' or Route::getCurrentRoute()->getName() == 'mensualidades.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-calendar"></i>
				<span class="menu-text"> Mensualidades </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'mensualidades.index' or 
        			Route::getCurrentRoute()->getName() == 'mensualidades.show' or 
        			Route::getCurrentRoute()->getName() == 'mensualidades.edit') class="active" @endif>
					<a href="{{ URL::route('mensualidades.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'mensualidades.create') class="active" @endif>
					<a href="{{ URL::route('mensualidades.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'constancias.index' or Route::getCurrentRoute()->getName() == 'constancias.show' or Route::getCurrentRoute()->getName() == 'constancias.edit' or Route::getCurrentRoute()->getName() == 'constancias.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-certificate"></i>
				<span class="menu-text"> Constancias </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'constancias.index' or 
        			Route::getCurrentRoute()->getName() == 'constancias.show' or 
        			Route::getCurrentRoute()->getName() == 'constancias.edit') class="active" @endif>
					<a href="{{ URL::route('constancias.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'constancias.create') class="active" @endif>
					<a href="{{ URL::route('constancias.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'eventos.index' or Route::getCurrentRoute()->getName() == 'eventos.show' or Route::getCurrentRoute()->getName() == 'eventos.edit' or Route::getCurrentRoute()->getName() == 'eventos.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-book"></i>
				<span class="menu-text"> Eventos </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'eventos.index' or 
					Route::getCurrentRoute()->getName() == 'eventos.show' or 
					Route::getCurrentRoute()->getName() == 'eventos.edit') class="active" @endif>
					<a href="{{ URL::route('eventos.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'eventos.create') class="active" @endif>
					<a href="{{ URL::route('eventos.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'cursos.index' or Route::getCurrentRoute()->getName() == 'cursos.show' or Route::getCurrentRoute()->getName() == 'cursos.edit' or Route::getCurrentRoute()->getName() == 'cursos.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-bookmark"></i>
				<span class="menu-text"> Cursos / Clases </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'cursos.index' or 
					Route::getCurrentRoute()->getName() == 'cursos.show' or 
					Route::getCurrentRoute()->getName() == 'cursos.edit') class="active" @endif>
					<a href="{{ URL::route('cursos.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'cursos.create') class="active" @endif>
					<a href="{{ URL::route('cursos.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		{{--
		<li @if(Route::getCurrentRoute()->getName() == 'horarios.index' or Route::getCurrentRoute()->getName() == 'horarios.show' or Route::getCurrentRoute()->getName() == 'horarios.edit' or Route::getCurrentRoute()->getName() == 'horarios.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-edit"></i>
				<span class="menu-text"> Horarios </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'horarios.index' or 
					Route::getCurrentRoute()->getName() == 'horarios.show' or 
					Route::getCurrentRoute()->getName() == 'horarios.edit') class="active" @endif>
					<a href="{{ URL::route('horarios.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'horarios.create') class="active" @endif>
					<a href="{{ URL::route('horarios.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		--}}
		<li @if(Route::getCurrentRoute()->getName() == 'sugerencias.index' or Route::getCurrentRoute()->getName() == 'sugerencias.show' or Route::getCurrentRoute()->getName() == 'sugerencias.edit' or Route::getCurrentRoute()->getName() == 'sugerencias.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-comment"></i>
				<span class="menu-text"> Sugerencias </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'sugerencias.index' or 
					Route::getCurrentRoute()->getName() == 'sugerencias.show' or 
					Route::getCurrentRoute()->getName() == 'sugerencias.edit') class="active" @endif>
					<a href="{{ URL::route('sugerencias.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'sugerencias.create') class="active" @endif>
					<a href="{{ URL::route('sugerencias.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		<li @if(Route::getCurrentRoute()->getName() == 'usuarios.index' or Route::getCurrentRoute()->getName() == 'usuarios.show' or Route::getCurrentRoute()->getName() == 'usuarios.edit' or Route::getCurrentRoute()->getName() == 'usuarios.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-group"></i>
				<span class="menu-text"> Usuarios </span>
				<b class="arrow icon-angle-down"></b>
			</a>
			<ul class="submenu">
				<li @if(Route::getCurrentRoute()->getName() == 'usuarios.index' or 
        			Route::getCurrentRoute()->getName() == 'usuarios.show' or 
        			Route::getCurrentRoute()->getName() == 'usuarios.edit') class="active" @endif>
					<a href="{{ URL::route('usuarios.index') }}">
						<i class="icon-double-angle-right"></i>
						Listado
					</a>
				</li>
				<li @if(Route::getCurrentRoute()->getName() == 'usuarios.create') class="active" @endif>
					<a href="{{ URL::route('usuarios.create') }}">
						<i class="icon-double-angle-right"></i>
						Agregar
					</a>
				</li>
			</ul>
		</li>
		
	</ul><!--/.nav-list-->
	<div class="sidebar-collapse" id="sidebar-collapse">
		<i class="icon-double-angle-left"></i>
	</div>
</div>