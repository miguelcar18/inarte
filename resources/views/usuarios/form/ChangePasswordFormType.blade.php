<div class="control-group">
	<label class="control-label" for="password">Contraseña actual:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::password('password_actual', ['id' => 'password_actual', 'class' => 'span6', 'placeholder' => 'Contraseña actual', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="password">Contraseña:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::password('password', ['id' => 'password', 'class' => 'span6', 'placeholder' => 'Contraseña nueva', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="password_confirmation">Repita contraseña:</label>
	<div class="controls">
		<div class="span12">
			{!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'span6', 'placeholder' => 'Repita la contraseña nueva', 'required' => true] ) !!}
		</div>
	</div>
</div>