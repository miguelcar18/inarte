<div class="control-group">
	<label class="control-label" for="dirigido">Dirigido a: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("dirigido", null, ["class" => "span6", "placeholder" => "Dirigido a", "id" => "dirigido", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="personal">Personal: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('personal', $personals, null, ['id' => 'personal', 'class' => 'span6', 'required' => true]) !!}
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