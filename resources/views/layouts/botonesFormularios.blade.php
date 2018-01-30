<div>
	<div class="form-actions">
	{!! Form::button('<i class="icon-save bigger-125"></i> '.$tituloBoton, ['type' => "submit", 'class' => "btn btn-info", 'data' => $valorData, 'id' => $idBoton]) !!}
	&nbsp;&nbsp;&nbsp;
	{!! Form::button('<i class="icon-remove bigger-125"></i> Cancelar', ['class' => "btn btn-danger", 'id' => "cancelar", 'type' => "button", 'onclick' => "document.location.href = '".$rutaCancelar."'"]) !!}
	</div>
	<div class="hr"></div>
</div>