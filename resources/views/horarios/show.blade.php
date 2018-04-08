@extends('layouts.base')

@section('titulo')<title>Datos del horario - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del horario", 'tituloModulo' => "Horarios", 'rutaModulo' => URL::route('horarios.index'), 'tituloSubmodulo' => "Datos del horario"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['horarios.destroy', $horario->id], 'method' =>'DELETE', 'id' => 'form-eliminar-horario', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>Profesor</th>
                <td>{{ $horario->profesor }}</td>
            </tr>
            <tr>
                <th width="25%">Horario</th>
                <td>{{ $horario->horario }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('horarios.edit', $horario->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger borrar" objeto="{{ $horario->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-horario'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop