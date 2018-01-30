@extends('layouts.base')

@section('titulo')
<title>Editar personal - Inarte</title>
@stop

@section('cabecera')
@include('layouts.breadcrumb', ['titulo' => "Editar personal", 'tituloModulo' => "Personal", 'rutaModulo' => URL::route('personal.index'), 'tituloSubmodulo' => "Editar personal"])
@stop

@section('contenido')
	<div class="panel panel-flat">
		<div class="panel-body">
			{{ Form::model($personal, ['route' => ['personal.update', $personal->id], "method" => "PUT", "name" => "personalForm", "id" => "personalForm", "class" => "form-horizontal"]) }}
				@include('personal.form.PersonalFormType', ["personal" => $personal])
				@include('layouts.botonesFormularios', ['tituloBoton' => "Actualizar", 'rutaCancelar' => URL::route('personal.index'), 'valorData' => 0, 'idBoton' => 'personalSubmit'])
			{{ Form::close() }}
		</div>
	</div>
@stop

@section('javascripts')
	<script type="text/javascript">
		$(function() {
			$('#file').ace_file_input({
				style:'well',
				btn_choose:'Arrastre la imagen o haga click para elegir',
				btn_change:null,
				no_icon:'icon-picture',
				droppable:true,
				thumbnail:'large',
				allowExt:  ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp'],
	    		allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/tif', 'image/tiff', 'image/bmp'],
				preview_error:function(filename, error_code) {
					alert(error_code);
				},
				before_change : function(files,dropped){
					var allowed_files = [];
					for(var i = 0 ; i < files.length; i++) {
						var file = files[i];
						if(typeof file === "string") {
							if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) 
								return false;
						}
						else {
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) ) || ( type.length === 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )	) 
								continue;
						}
						allowed_files.push(file);
					}
					if(allowed_files.length === 0) return false;
						return allowed_files;
				}
			}).on('change', function(){
			});
		});
	</script>
@stop