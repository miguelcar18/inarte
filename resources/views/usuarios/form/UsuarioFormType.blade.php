<div class="control-group">
	<label class="control-label" for="name">Imagen:</label>
	<div class="controls">
		<div class="span6">
			{!! Form::file('file', ['id' => 'file', 'class' => 'file-styled', 'accept' => 'image/jpg,image/png,image/jpeg,image/gif']) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="name">Nombre y apellido:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::text('name', null, ['id' => 'name', 'class' => 'span6', 'placeholder' => 'Nombre y apellido', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="email">Correo:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::email('email', null, ['id' => 'email', 'class' => 'span6', 'placeholder' => 'Correo', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="username">Nombre de usuario:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::text('username', null, ['id' => 'username', 'class' => 'span6', 'placeholder' => 'Nombre de usuario', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="password">Contraseña:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::password('password', ['id' => 'password', 'class' => 'span6', 'placeholder' => 'Contraseña', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="password_repeat">Repita contraseña:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::password('password_repeat', ['id' => 'password_repeat', 'class' => 'span6', 'placeholder' => 'Repita la contraseña', 'required' => true] ) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="rol">Rol: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('rol', ["" => "Seleccione una opción", "1" => "Administrador", "0" => "Usuario"], null, ['id' => 'rol', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>