<div class="control-group">
	<label class="control-label" for="disciplina">Disciplina: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('disciplina', $disciplinas, null, ['id' => 'disciplina', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="mes">Mes: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('mes', ["" => "Seleccione una opción", "Enero" => "Enero", "Febrero" => "Febrero", "Marzo" => "Marzo", "Abril" => "Abril", "Mayo" => "Mayo", "Junio" => "Junio", "Julio" => "Julio", "Agosto" => "Agosto", "Septiembre" => "Septiembre", "Octubre" => "Octubre", "Noviembre" => "Noviembre", "Diciembre" => "Diciembre"], null, ['id' => 'mes', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="anio">Año: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("anio", null, ["class" => "span6", "placeholder" => "Año", "id" => "anio", 'required' => true]) }}
		</div>
	</div>
</div>