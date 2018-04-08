<div class="control-group">
	<label class="control-label" for="nombre">Nombre: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("nombre", null, ["class" => "span6", "placeholder" => "Nombre del evento", "id" => "nombre", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="empresa">Empresa: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("empresa", null, ["class" => "span6", "placeholder" => "Nombre de la empresa", "id" => "empresa", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="dirigido">Fecha: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			@if(isset($evento->fecha))
			<?php 
				$separarFecha =  explode('-', $evento->fecha);
				$fechaNormal =  $separarFecha[2].'-'.$separarFecha[1].'-'.$separarFecha[0];
			?>
			{!! Form::text('fecha',  $fechaNormal, ['id' => 'fecha', 'class' => 'span6 date-picker', 'placeholder' => 'Fecha', 'data-date-format' => "dd-mm-yyyy"]) !!}
			@else
			{!! Form::text('fecha', null, ['id' => 'fecha', 'class' => 'span6 date-picker', 'placeholder' => 'Fecha', 'data-date-format' => "dd-mm-yyyy"]) !!}
			@endif
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
	<label class="control-label" for="disciplina">Disciplina: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('disciplina', $disciplinas, null, ['id' => 'disciplina', 'class' => 'span6 selectDisciplinas', 'required' => true]) !!}
		</div>
	</div>
</div>