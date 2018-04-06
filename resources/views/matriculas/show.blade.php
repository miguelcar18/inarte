@extends('layouts.base')

@section('titulo')<title>Datos de la matricula - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la matricula", 'tituloModulo' => "Matriculas", 'rutaModulo' => URL::route('matriculas.index'), 'tituloSubmodulo' => "Datos de la matricula"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['matriculas.destroy', $matricula->id], 'method' =>'DELETE', 'id' => 'form-eliminar-matricula', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="25%">Cédula</th>
                <td>{{ number_format($matricula->cedula, 0, '', '.') }}</td>
            </tr>
            <tr>
                <th>Nombre y apellido</th>
                <td>{{ $matricula->nombre }}</td>
            </tr>
            <tr>
                <th width="25%">Cédula del representante</th>
                <td>{{ number_format($matricula->cedulaRepresentante, 0, '', '.') }}</td>
            </tr>
            <tr>
                <th>Nombre y apellido del representante</th>
                <td>{{ $matricula->representante }}</td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td>{{ date_format(date_create($matricula->fechaNacimiento), 'd/m/Y') }}</td>
            </tr>
            <tr>
                <th>Disciplina</th>
                <td>{{ $matricula->nombreDisciplina->nombre }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('matriculas.edit', $matricula->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $matricula->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-matricula'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop