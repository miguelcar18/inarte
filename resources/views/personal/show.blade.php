@extends('layouts.base')

@section('titulo')<title>Datos del personal - Inarte</title>@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Datos del personal", 'tituloModulo' => "Personal", 'rutaModulo' => URL::route('personal.index'), 'tituloSubmodulo' => "Datos del personal"])
@stop

@section('contenido')
	{!! Form::open(['route' => ['personal.destroy', $personal->id], 'method' =>'DELETE', 'id' => 'form-eliminar-personal', 'onSubmit' => 'return confirm(\'\\u00bfEst\\u00e1 realmente seguro(a) de eliminar este registro?\')']) !!}

    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td colspan="2" align="center">
                    <div class="span6">
                        <span class="profile-picture" id="cambiante">
                            @if($personal->foto == '')
                            <img id="avatar2" alt="{{ $personal->nombre }} foto" src="{{ asset('uploads/personal/unfile.png') }}" height="50px" width="auto" />
                            @else
                            <img id="avatar2" alt="{{ $personal->nombre }} foto" src="{{ asset('uploads/personal/'.$personal->foto) }}" height="50px" width="auto" />
                            @endif
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Nombre y apellido</th>
                <td>{{ $personal->nombre }}</td>
            </tr>
            <tr>
                <th>Tipo de personal</th>
                <td>{{ $personal->tipo }}</td>
            </tr>
            <tr>
                <th>Cargo</th>
                <td>{{ $personal->cargo }}</td>
            </tr>
            <tr>
                <th>Edad</th>
                <td>{{ $personal->edad }}</td>
            </tr>
            <tr>
                <th>Tiempo en la empresa</th>
                <td>{{ $personal->tiempo }}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{ $personal->telefono }}</td>
            </tr>
            <tr>
                <th>Eventos que ha participado</th>
                <td>{{ $personal->eventos }}</td>
            </tr>
            <tr>
				<td class="col-md-3 col-sm-4"><b>Acciones</b></td>
				<td>
					<button type="button" id="editar" name="editar" class="btn btn-success" onclick="document.location.href = '{{ URL::route('personal.edit', $personal->id) }}'"> <i class="icon-pencil bigger-120"></i> Editar</button>

					<button type="button" id="eliminar" name="eliminar" class="btn btn-danger tooltip-error borrar" objeto="{{ $personal->id }}"  onclick="return confirmSubmit(document.forms['form-eliminar-personal'], '¿Está realmente seguro de eliminar este registro?');"><i class="icon-trash position-right"></i> Eliminar</button>
				</td>
			</tr>
        </tbody>
    </table>
    {!! Form::close() !!}
@stop