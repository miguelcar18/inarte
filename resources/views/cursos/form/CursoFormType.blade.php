<div class="control-group">
	<label class="control-label" for="curso">Curso: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("curso", null, ["class" => "span6", "placeholder" => "Curso", "id" => "curso", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="lugar">Lugar: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("lugar", null, ["class" => "span6", "placeholder" => "Lugar", "id" => "lugar", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="profesor">Profesor: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("profesor", null, ["class" => "span6", "placeholder" => "Profesor(es)", "id" => "profesor"]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="horario">Horario: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::textarea("horario", null, ["class" => "span6", "placeholder" => "Horario del curso", "id" => "horario", 'required' => true]) }}
		</div>
	</div>
</div>