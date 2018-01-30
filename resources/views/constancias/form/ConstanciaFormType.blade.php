<div class="control-group">
	<label class="control-label" for="dirigido">Dirigido a: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("dirigido", null, ["class" => "span6", "placeholder" => "Dirigido a", "id" => "dirigido", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="cedula">Cédula: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("cedula", null, ["class" => "span6", "placeholder" => "Número de cédula", "id" => "cedula", 'required' => true]) }}
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
	<label class="control-label" for="tiempo">Tiempo en la empresa: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("tiempo", null, ["class" => "span6", "placeholder" => "Tiempo en la empresa", "id" => "tiempo"]) }}
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
			{!! Form::select('tipo', ["" => "Seleccione una opción", "Constancia de estudio" => "Constancia de estudio", "Constancia de participación de eventos" => "Constancia de participación de eventos"], null, ['id' => 'tipo', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>