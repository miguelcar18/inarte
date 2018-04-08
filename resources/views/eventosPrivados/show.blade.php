@extends('layouts.base')

@section('titulo')<title>Datos del evento privado - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del evento privado", 'tituloModulo' => "Eventos Privados", 'rutaModulo' => URL::route('eventosPrivados.index'), 'tituloSubmodulo' => "Datos del evento privado"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['eventosPrivados.destroy', $evento->id], 'method' =>'DELETE', 'id' => 'form-eliminar-evento-privado', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $evento->id }}</td>
            </tr>
            <tr>
                <th>Nombre</th>
                <td>{{ $evento->nombre }}</td>
            </tr>
            <tr>
                <th>Empresa</th>
                <td>{{ $evento->empresa }}</td>
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
                <th>Disciplina</th>
                <td>{{ $evento->nombreDisciplina->nombre }}</td>
            </tr>
            <tr>
                <th>Participantes</th>
                <td>
                    <ul>
                        @foreach($datos as $data)
                        <li>{{ $data->nombreMatricula->cedula_nombre }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('eventosPrivados.edit', $evento->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger borrar" objeto="{{ $evento->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-evento-privado'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop