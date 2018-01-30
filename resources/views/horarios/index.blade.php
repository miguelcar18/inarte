@extends('layouts.base')

@section('titulo')
<title>Horarios - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Horarios", 'tituloModulo' => "Horarios"])
@stop

@section('javascripts')
	<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>
	<script type="text/javascript">
		$(function() {
			var oTable1 = $('#sample-table-2').dataTable({
				"aoColumns": [
					null, null,null,
					{ "bSortable": false }
				], 
				"oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ ",
					"sZeroRecords": "No existen datos para esta consulta",
					"sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
					"sInfoFiltered": "(De un maximo de _MAX_ registros)",
					"sSearch": "Buscar: _INPUT_",
					"sEmptyTable": "No hay datos disponibles para esta tabla",
					"sLoadingRecords": "Por favor espere - Cargando...",  
					"sProcessing": "Actualmente ocupado",
					"sSortAscending": " - click/Volver a ordenar en orden Ascendente",
					"sSortDescending": " - click/Volver a ordenar en orden descendente",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Ultimo",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
				}
			});

			@if(Session::has('message'))
                var mensaje1 = "{{ Session::get('message') }}";
                $.gritter.add({
                    title: 'Eliminado',
                    text: mensaje1,
                    class_name: 'gritter-success'
                });
            @endif
		})
	</script>
@stop

@section('contenido')

<div class="row-fluid">
	<h3 class="header smaller lighter blue">Listado de horarios registrados</h3>
	<table id="sample-table-2" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>ID</th>
                <th>Profesor</th>
                <th>Horario</th>
                <th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($horarios as $horario)
            <tr>
                <td>{{ $horario->id }}</td>
				<td>{{ $horario->profesor }}</td>
				<td>{{ $horario->horario }}</td>
                <td class="hidden-480">
                    <a href="{{ URL::route('horarios.show', $horario->id) }}" data-rel="tooltip" title="Mostrar {{ $horario->id }}" objeto="{{ $horario->id }}" style="text-decoration:none;" data-id="{{ $horario->id }}"> 
                        <span class="btn btn-mini btn-info"> <i class="icon-eye-open bigger-120"></i> </span> 
                    </a>
                    &nbsp;
                    <a href="{{ URL::route('horarios.edit', $horario->id) }}" class="tooltip-success editar" data-rel="tooltip" title="Editar {{ $horario->id }}" objeto="{{ $horario->id }}" style="text-decoration:none;" data-id="{{ $horario->id }}"> 
                        <span class="btn btn-mini btn-success"> <i class="icon-pencil bigger-120"></i> </span> 
                    </a>
                    &nbsp;
                    <a href="#" data-id="{{ $horario->id }}" class="tooltip-error borrar" data-rel="tooltip" title="Eliminar {{ $horario->id }}" objeto="{{ $horario->id }}"> 
                        <span class="btn btn-mini btn-danger"> <i class="icon-remove bigger-120"></i> </span> 
                    </a>
                </td>
            </tr>
        @endforeach
		</tbody>
	</table>
	{!! Form::open(array('route' => array('horarios.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) !!}
        {!! Form::close() !!}
</div>

@stop