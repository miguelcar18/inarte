@extends('layouts.base')

@section('titulo')<title>Datos de la mensualidad - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la mensualidad", 'tituloModulo' => "Mensualidades", 'rutaModulo' => URL::route('mensualidades.index'), 'tituloSubmodulo' => "Datos de la mensualidad"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['mensualidades.destroy', $mensualidad->id], 'method' =>'DELETE', 'id' => 'form-eliminar-mensualidad', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            @if($mensualidad->nombreMatricula->cedula != "")
            <tr>
                <th width="25%">Cédula</th>
                <td>{{ number_format($mensualidad->nombreMatricula->cedula, 0, '', '.') }}</td>
            </tr>
            @endif
            <tr>
                <th>Nombre y apellido</th>
                <td>{{ $mensualidad->nombreMatricula->nombre }}</td>
            </tr>
            @if($mensualidad->nombreMatricula->representante != "")
            <tr>
                <th>Nombre del representante</th>
                <td>{{ $mensualidad->nombreMatricula->representante }}</td>
            </tr>
			@endif
            <tr>
                <th>Banco del cual se hizo la transferencia</th>
                <td>{{ $mensualidad->banco }}</td>
            </tr>
            <tr>
                <th>Numero de comprobante</th>
                <td>{{ $mensualidad->comprobante }}</td>
            </tr>
            <tr>
                <th>Mes</th>
                <td>{{ $mensualidad->mes }}</td>
            </tr>
            <tr>
                <th>Año</th>
                <td>{{ $mensualidad->anio }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('mensualidades.edit', $mensualidad->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $mensualidad->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-mensualidad'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop