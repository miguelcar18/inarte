<div class="control-group">
	<label class="control-label" for="nombre">Nombre: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("nombre", null, ["class" => "span6", "placeholder" => "Nombre", "id" => "nombre", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="descripcion">Descripción:</label>
	<div class="controls">
		<div class="span12">
			{{ Form::textarea("descripcion", null, ["class" => "span6", "placeholder" => "Descripción", "id" => "descripcion", "rows" => 4]) }}
		</div>
	</div>
</div>