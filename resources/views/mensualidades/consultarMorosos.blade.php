@extends('layouts.base')

@section('titulo')
<title>Consultar deudores - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Consultar deudores", 'tituloModulo' => "Mensualidades", 'rutaModulo' => URL::route('mensualidades.index'), 'tituloSubmodulo' => "Consultar deudores"])
@stop

@section('javascripts')
	<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>
	<script type="text/javascript">
		$(function() {
			var oTable1 = $('#sample-table-2').dataTable({
				"aoColumns": [
					null, null,null
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
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::open(["method" => "post", "route" =>'postMorosos', "name" => "morososMensualidadForm", "id" => "morososMensualidadForm", "class" => "form-horizontal"]) }}
				@include('mensualidades.form.MorososMensualidadFormType')
				<div>
					<div class="form-actions">
						{!! Form::button('<i class="icon-search bigger-125"></i> Buscar', ['type' => "submit", 'class' => "btn btn-info", 'data' => 1, 'id' => 'morososMensualidadSubmit']) !!}
						&nbsp;&nbsp;&nbsp;
						{!! Form::button('<i class="icon-remove bigger-125"></i> Cancelar', ['class' => "btn btn-danger", 'id' => "cancelar", 'type' => "button", 'onclick' => "document.location.href = '".URL::route('mensualidades.index')."'"]) !!}
					</div>
					<div class="hr"></div>
				</div>
			{{ Form::close() }}
			<div id="resultados">
                <table id="sample-table" class="table table-striped table-bordered table-hover datatable-basic">
                    <thead>
                    	<tr>
                    		<th>Cédula</th>
                    		<th>Nombre y apellido</th>
                    		<th>Disciplina</th>
                    	</tr>
                    </thead>
                    <tbody>
                    	
                    </tbody>
                </table>
            </div>
		</div>
	</div>
@stop