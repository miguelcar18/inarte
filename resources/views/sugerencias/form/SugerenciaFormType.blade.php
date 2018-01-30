<div class="control-group">
	<label class="control-label" for="nombre">Realizada por: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("nombre", null, ["class" => "span6", "placeholder" => "Nombre", "id" => "nombre", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="sugerencia">Sugerencia: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::textarea("sugerencia", null, ["class" => "span6", "placeholder" => "Sugerencia u opinión", "id" => "sugerencia", 'required' => true]) }}
		</div>
	</div>
</div>