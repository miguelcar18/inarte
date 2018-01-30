@extends('layouts.base')

@section('titulo')<title>Datos de la constancia - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la constancia", 'tituloModulo' => "Constancias", 'rutaModulo' => URL::route('constancias.index'), 'tituloSubmodulo' => "Datos de la constancia"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['constancias.destroy', $constancia->id], 'method' =>'DELETE', 'id' => 'form-eliminar-constancia', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>Dirigido a</th>
                <td>{{ $constancia->dirigido }}</td>
            </tr>
            <tr>
                <th width="25%">Cédula</th>
                <td>{{ number_format($constancia->cedula, 0, '', '.') }}</td>
            </tr>
            <tr>
                <th>Nombre y apellido</th>
                <td>{{ $constancia->nombre }}</td>
            </tr>
            <tr>
                <th>Tiempo en la empresa</th>
                <td>{{ $constancia->tiempo }}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{ $constancia->telefono }}</td>
            </tr>
            <tr>
                <th>Tipo de constancia</th>
                <td>{{ $constancia->tipo }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('constancias.edit', $constancia->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $constancia->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-constancia'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop