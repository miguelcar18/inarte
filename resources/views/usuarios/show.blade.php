@extends('layouts.base')

@section('titulo')<title>Datos de la mensualidad - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la mensualidad", 'tituloModulo' => "Mensualidades", 'rutaModulo' => URL::route('mensualidades.index'), 'tituloSubmodulo' => "Datos de la mensualidad"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="table-responsive">
			{!! Form::open(['route' => ['mensualidades.destroy', $mensualidad->id], 'method' =>'DELETE', 'id' => 'form-eliminar-mensualidad', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}
			<table class="table table-bordered table-lg">
				<tbody>
					<tr class="active">
						<th colspan="2">Datos de la mensualidad</th>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-4"><b>Cédula</b></td>
						<td>{{ number_format($mensualidad->cedula, 0, '', '.') }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-4"><b>Nombre y apellido</b></td>
						<td>{{ $mensualidad->nombre }}</td>
					</tr>
					@if($mensualidad->representante != "")
					<tr>
						<td class="col-md-3 col-sm-4"><b>Nombre del representante</b></td>
						<td>{{ $mensualidad->representante }}</td>
					</tr>
					@endif
					<tr>
						<td class="col-md-3 col-sm-4"><b>Banco del cual se hizo la transferencia</b></td>
						<td>{{ $mensualidad->banco }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-4"><b>Numero de comprobante</b></td>
						<td>{{ $mensualidad->comprobante }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-4"><b>Mes</b></td>
						<td>{{ $mensualidad->mes }}</td>
					</tr>
					<tr>
						<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
						<td>
							<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('mensualidades.edit', $mensualidad->id) }}'"><i class="icon-pencil7 position-right"></i> Editar</button>
							<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $mensualidad->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-mensualidad'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
						</td>
					</tr>
				</tbody>
			</table>
			{!! form::close() !!}
		</div>
	</div>
@stop