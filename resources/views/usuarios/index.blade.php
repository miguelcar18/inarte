@extends('layouts.base')

@section('titulo')
<title>Usuarios - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Usuarios", 'tituloModulo' => "Usuarios"])
@stop

@section('contenido')

<div class="row-fluid">
	<h3 class="header smaller lighter blue">jQuery dataTables</h3>
	<div class="table-header">
		Results for "Latest Registered Domains"
	</div>

	<table id="sample-table-2" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Usuario</th>
                <th>Nombre y apellido</th>
                <th>Email</th>
                <th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="hidden-480">
                    <a href="{{ URL::route('usuarios.show', $user->id) }}" data-rel="tooltip" title="Mostrar {{ $user->username }}" objeto="{{ $user->username }}"> 
                        <span class="btn btn-mini btn-info"> <i class="icon-eye-open bigger-120"></i> </span> 
                    </a>
                    &nbsp;
                    <a href="{{ URL::route('usuarios.edit', $user->id) }}" class="tooltip-success editar" data-rel="tooltip" title="Editar {{ $user->username }}" objeto="{{ $user->username }}" style="text-decoration:none;"> 
                        <span class="btn btn-mini btn-success"> <i class="icon-pencil bigger-120"></i> </span> 
                    </a>
                    &nbsp;
                    <a href="#" data-id="{{ $user->id }}" class="tooltip-error borrar" data-rel="tooltip" title="Eliminar {{ $user->username }}" objeto="{{ $user->username }}"> 
                        <span class="btn btn-mini btn-danger"> <i class="icon-remove bigger-120"></i> </span> 
                    </a>
                </td>
            </tr>
        @endforeach
		</tbody>
	</table>
</div>

@stop