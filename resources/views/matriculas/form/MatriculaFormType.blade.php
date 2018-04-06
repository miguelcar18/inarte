<div class="control-group">
	<label class="control-label" for="cedula">Cédula:</label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("cedula", null, ["class" => "span6", "placeholder" => "Número de cédula", "id" => "cedula"]) }}
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
	<label class="control-label" for="cedulaRepresentante">Cédula del representante:</label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("cedulaRepresentante", null, ["class" => "span6", "placeholder" => "Número de cédula del representante", "id" => "cedulaRepresentante"]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="representante">Nombre del representante:</label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("representante", null, ["class" => "span6", "placeholder" => "Nombre y apellido del representante", "id" => "representante"]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="fechaNacimiento">Fecha de nacimiento: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			@if(isset($matricula->fechaNacimiento))
			<?php 
				$separarFecha =  explode('-', $matricula->fechaNacimiento);
				$fechaNormal =  $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
			?>
			{!! Form::text('fechaNacimiento',  $fechaNormal, ['id' => 'fechaNacimiento', 'class' => 'span6 date-picker', 'placeholder' => 'Fecha de nacimiento', 'data-date-format' => "dd-mm-yyyy"]) !!}
			@else
			{!! Form::text('fechaNacimiento', null, ['id' => 'fechaNacimiento', 'class' => 'span6 date-picker', 'placeholder' => 'Fecha de nacimiento', 'data-date-format' => "dd-mm-yyyy"]) !!}
			@endif
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="disciplina">Disciplina: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('disciplina', $disciplinas, null, ['id' => 'disciplina', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>