<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		@section('titulo') <title>Panel principal - Inarte</title> @show
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
		<!--basic styles-->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-responsive.min.css') }}"/>
		<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-ie7.min.css') }}" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
		<!--ace styles-->

		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-responsive.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/jquery.gritter.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/datepicker.css') }}" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->
		<!--inline styles related to this page-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		@section('estilos') @show
	</head>
	<body class="skin-2 navbar-fixed breadcrumbs-fixed">
		@include('layouts.navbar')
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			@include('layouts.sidebar')
			<div class="main-content">
				@section('cabecera')
				@include('layouts.breadcrumb', ['titulo' => "Panel de inicio"])
				@show
				<br>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->
							@section('contenido')
							@include('layouts.inicio')
							@show
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->
		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->
		<!--[if !IE]>-->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<!--<![endif]-->
		<!--[if IE]>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<![endif]-->

		<!--[if !IE]>-->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{ asset("assets/js/jquery-2.0.3.min.js") }}'>"+"<"+"/script>");
		</script>
		<!--<![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='{{ asset("assets/js/jquery-1.10.2.min.js") }}'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='{{ asset("assets/js/jquery.mobile.custom.min.js") }}'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.gritter.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.js') }}"></script>
		<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace.min.js') }}"></script>
		<script src="{{ asset('assets/js/date-time/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/custom.js') }}"></script>

		<!--page specific plugin scripts-->

		@section('javascripts')
		@show

		<!--inline scripts related to this page-->
	</body>
</html>
