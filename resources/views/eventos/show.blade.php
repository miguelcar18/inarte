@extends('layouts.base')

@section('titulo')<title>Datos del evento - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del evento", 'tituloModulo' => "Eventos", 'rutaModulo' => URL::route('eventos.index'), 'tituloSubmodulo' => "Datos del evento"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['eventos.destroy', $evento->id], 'method' =>'DELETE', 'id' => 'form-eliminar-constancia', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $evento->id }}</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>{{ date_format(date_create($evento->fecha), 'd/m/Y') }}</td>
            </tr>
            <tr>
                <th>Lugar</th>
                <td>{{ $evento->lugar }}</td>
            </tr>
            <tr>
                <th>Participantes</th>
                <td>{{ $evento->participantes }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('eventos.edit', $evento->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $evento->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-constancia'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop