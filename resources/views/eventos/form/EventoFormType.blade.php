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
	<label class="control-label" for="participantes">Participantes: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::textarea("participantes", null, ["class" => "span6", "placeholder" => "Participantes", "id" => "participantes", 'required' => true]) }}
		</div>
	</div>
</div>