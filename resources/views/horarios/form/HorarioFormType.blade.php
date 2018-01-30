<div class="control-group">
	<label class="control-label" for="profesor">Profesor: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("profesor", null, ["class" => "span6", "placeholder" => "Profesor", "id" => "profesor", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="horario">Horario: <small class="text-error">*</small> <br> (Día: Desde - Hasta)</label>
	<div class="controls">
		<div class="span12">
			{{ Form::textarea("horario", null, ["class" => "span6", "placeholder" => "Horario", "id" => "horario", 'required' => true]) }}
		</div>
	</div>
</div>