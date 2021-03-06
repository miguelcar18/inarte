<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Crear nueva contraseña - Inarte</title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
		<!--basic styles-->
		<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/bootstrap-responsive.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-ie7.min.css') }}" />
		<![endif]-->
		<!--page specific plugin styles-->
		<!--fonts-->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />
		<!--ace styles-->
		<link href="{{ asset('assets/css/ace.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/ace-responsive.min.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/css/ace-skins.min.css') }}" rel="stylesheet" />
		<link rel="stylesheet" href="{{ asset('assets/css/jquery.gritter.css') }}" />
		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->
		<!--inline styles related to this page-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body class="login-layout" style="background: none">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h1>
										<i class="icon-leaf green"></i>
										<span class="red">INARTE</span>
									</h1>
									<h4 class="blue">Inversiones Arriba el Telón C.A</h4>
								</div>
							</div>
							<div class="space-6"></div>
							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-desktop green"></i>
													Crear nueva contraseña
												</h4>
												<div class="space-6"></div>
												<div id="respuesta"></div>
												{!! Form::open(['route' => 'password.request', 'method' => 'POST', 'id' => 'formChangePassword', 'name' => 'formChangePassword', 'class' => '']) !!}
													{{ csrf_field() }}
													<input type="hidden" name="token" value="{{ $token }}">
													<fieldset>
														<label>
															<span class="block input-icon input-icon-right">
																{!! Form::email('email', null, ['placeholder' => 'Email', 'class' => 'span12', 'id' => 'email', 'required' => true, 'value' => $email or old('email')]) !!}
																<i class="icon-envelope"></i>
															</span>
														</label>
														@if ($errors->has('email'))
														<label>
															<span class="help-block">
																<strong>{{ $errors->first('email') }}</strong>
															</span>
														</label>
														@endif
														<label>
															<span class="block input-icon input-icon-right">
																{!! Form::password('password', ['placeholder' => 'Contraseña', 'class' => 'span12', 'id' => 'password', 'required' => true]) !!}
																<i class="icon-lock"></i>
															</span>
														</label>
														@if ($errors->has('password'))
														<label>
															<span class="help-block">
						                                        <strong>{{ $errors->first('password') }}</strong>
						                                    </span>
														</label>
														@endif
														<label>
															<span class="block input-icon input-icon-right">
																{!! Form::password('password_confirmation', ['placeholder' => 'Repetir contraseña', 'class' => 'span12', 'id' => 'password-confirm', 'required' => true]) !!}
																<i class="icon-lock"></i>
															</span>
														</label>
														@if ($errors->has('password_confirmation'))
														<label>
															<span class="help-block">
						                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
						                                    </span>
														</label>
														@endif
														<div class="space"></div>
														<div class="clearfix">
															{!! Form::button('<i class="icon-key"></i> Cambiar contraseña', ['class'=> 'pull-right btn btn-small btn-primary', 'id' => 'ChangePasswordButton', 'type' => 'submit']) !!}
														</div>
														<div class="space-4"></div>
													</fieldset>
												{!! Form::close()!!}
											</div><!--/widget-main-->
											<div class="toolbar clearfix">
												<div class="text-center">
													<a href="{{ URL::route('login') }}" class="forgot-password-link">
														Regresar al login
													</a>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->
		<!--basic scripts-->
		<!--[if !IE]>-->
			<script type="text/javascript">
				window.jQuery || document.write("<script src='{{ asset('assets/js/jquery-2.0.3.min.js') }}'>"+"<"+"/script>");
			</script>
		<!--<![endif]-->
		<!--[if IE]>
			<script type="text/javascript">
		 		window.jQuery || document.write("<script src='{{ asset('assets/js/jquery-1.10.2.min.js') }}'>"+"<"+"/script>");
			</script>
		<![endif]-->
		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<!--page specific plugin scripts-->
		<!--ace scripts-->
		<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
		<script src="{{ asset('assets/js/ace.min.js') }}"></script>
		<!--inline scripts related to this page-->
		<script type="text/javascript">
			function show_box(id) {
				$('.widget-box.visible').removeClass('visible');
				$('#'+id).addClass('visible');
			}
		</script>
	</body>
</html>