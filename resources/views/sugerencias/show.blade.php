@extends('layouts.base')

@section('titulo')<title>Datos de la sugerencia - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la sugerencia", 'tituloModulo' => "Sugerencias", 'rutaModulo' => URL::route('sugerencias.index'), 'tituloSubmodulo' => "Datos de la sugerencia"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['sugerencias.destroy', $sugerencia->id], 'method' =>'DELETE', 'id' => 'form-eliminar-sugerencia', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>Realizada por</th>
                <td>{{ $sugerencia->nombre }}</td>
            </tr>
            <tr>
                <th width="25%">Sugerencia</th>
                <td>{{ $sugerencia->sugerencia }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('sugerencias.edit', $sugerencia->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $sugerencia->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-sugerencia'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop