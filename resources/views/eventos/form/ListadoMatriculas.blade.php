<div class="control-group">
	<label class="control-label" for="participantes">Participantes: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('participantes', $matriculas, null, ['id' => 'participantes', 'class' => 'span6']) !!}
			<button type="button" id="agregarFila" onclick="agregarValor()" class="btn btn-mini btn-info"><i class="icon-plus bigger-120"></i></button>

		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table id="tablaParticipantes" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>Participantes</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($listado))
				@foreach($listado as $data)
				<tr>
					<td>
						<input type="hidden" name="matriculaA[]" id="matriculaA[]" value="{{ $data->matricula }}" /> {{ number_format($data->nombreMatricula->cedula, 0, '', '.').' - '.ucfirst($data->nombreMatricula->nombre) }}
					</td>
					<td>
						<button type="button" onclick="eliminarFilaEditar(this)" class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>