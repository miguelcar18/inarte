<div class="sidebar fixed" id="sidebar">
	<ul class="nav nav-list">
		<li @if(Route::getCurrentRoute()->getName() == 'principal') class="active"  @else class="" @endif >
			<a href="{{ URL::route('principal') }}">
				<i class="icon-dashboard"></i>
				<span class="menu-text"> Inicio </span>
			</a>
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
		<li @if(Route::getCurrentRoute()->getName() == 'usuarios.index' or Route::getCurrentRoute()->getName() == 'usuarios.show' or Route::getCurrentRoute()->getName() == 'usuarios.edit' or Route::getCurrentRoute()->getName() == 'usuarios.create') class="active open" @endif>
			<a href="#" class="dropdown-toggle">
				<i class="icon-user"></i>
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