<div class="control-group">
	<label class="control-label" for="name">Imagen:</label>
	<div class="controls">
		<div class="span6">
			{!! Form::file('foto', ['id' => 'foto', 'class' => 'file-styled', 'accept' => 'image/jpg,image/png,image/jpeg,image/gif']) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="cargo">Cargo: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("cargo", null, ["class" => "span6", "placeholder" => "Cargo", "id" => "cargo", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="edad">Edad: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("edad", null, ["class" => "span6", "placeholder" => "Edad", "id" => "edad", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="nombre">Nombre y apellido: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("nombre", null, ["class" => "span6", "placeholder" => "Nombre y apellido", "id" => "nombre", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="cedula">Cédula: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("cedula", null, ["class" => "span6", "placeholder" => "Cédula", "id" => "cedula", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="fechaIngreso">Fecha de ingreso: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			@if(isset($personal->fechaIngreso))
			<?php 
				$separarFecha =  explode('-', $personal->fechaIngreso);
				$fechaNormal =  $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
			?>
			{!! Form::text('fechaIngreso',  $fechaNormal, ['id' => 'fechaIngreso', 'class' => 'span6 date-picker', 'placeholder' => 'Fecha de ingreso', 'data-date-format' => "dd-mm-yyyy"]) !!}
			@else
			{!! Form::text('fechaIngreso', null, ['id' => 'fechaIngreso', 'class' => 'span6 date-picker', 'placeholder' => 'Fecha de ingreso', 'data-date-format' => "dd-mm-yyyy"]) !!}
			@endif
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="telefono">Teléfono: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("telefono", null, ["class" => "span6", "placeholder" => "Teléfono", "id" => "telefono"]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="tipo">Tipo: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('tipo', ["" => "Seleccione una opción", "Director" => "Director", "Profesor" => "Profesor"], null, ['id' => 'tipo', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="eventos">Eventos participados:</label>
	<div class="controls">
		<div class="span12">
			{{ Form::textarea("eventos", null, ["class" => "span6", "placeholder" => "", "id" => "eventos", "rows" => 4]) }}
		</div>
	</div>
</div>