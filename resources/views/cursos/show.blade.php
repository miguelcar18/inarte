@extends('layouts.base')

@section('titulo')<title>Datos del curso - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del curso", 'tituloModulo' => "Curso", 'rutaModulo' => URL::route('cursos.index'), 'tituloSubmodulo' => "Datos del curso"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['cursos.destroy', $curso->id], 'method' =>'DELETE', 'id' => 'form-eliminar-curso', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>Curso</th>
                <td>{{ $curso->curso }}</td>
            </tr>
            <tr>
                <th width="25%">Profesor</th>
                <td>{{ $curso->profesor }}</td>
            </tr>
            <tr>
                <th>Lugar</th>
                <td>{{ $curso->lugar }}</td>
            </tr>
            <tr>
                <th>Horario</th>
                <td>{{ $curso->horario }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('cursos.edit', $curso->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger borrar" objeto="{{ $curso->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-curso'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop