@extends('layouts.base')

@section('titulo')<title>Datos del alumno - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del alumno", 'tituloModulo' => "Alumnos", 'rutaModulo' => URL::route('alumnos.index'), 'tituloSubmodulo' => "Datos del alumno"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['alumnos.destroy', $alumno->id], 'method' =>'DELETE', 'id' => 'form-eliminar-alumno', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>Nombre y apellido</th>
                <td>{{ $alumno->nombre }}</td>
            </tr>
            <tr>
                <th>Edad</th>
                <td>{{ $alumno->edad }}</td>
            </tr>
            @if($alumno->representante != "")
            <tr>
                <th>Nombre del representante</th>
                <td>{{ $alumno->representante }}</td>
            </tr>
			@endif
            <tr>
                <th>Banco del cual se hizo la transferencia</th>
                <td>{{ $alumno->banco }}</td>
            </tr>
            <tr>
                <th>Numero de comprobante</th>
                <td>{{ $alumno->comprobante }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('alumnos.edit', $alumno->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $alumno->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-alumno'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop