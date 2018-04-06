@extends('layouts.base')

@section('titulo')<title>Datos de la disciplina - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos de la disciplina", 'tituloModulo' => "Disciplinas", 'rutaModulo' => URL::route('disciplinas.index'), 'tituloSubmodulo' => "Datos de la disciplina"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['disciplinas.destroy', $disciplina->id], 'method' =>'DELETE', 'id' => 'form-eliminar-disciplina', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th width="25%">ID</th>
                <td>{{ $disciplina->id }}</td>
            </tr>
            <tr>
                <th>Nombre y apellido</th>
                <td>{{ $disciplina->nombre }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ $disciplina->descripcion }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('disciplinas.edit', $disciplina->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $disciplina->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-disciplina'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop