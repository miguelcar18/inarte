<div class="breadcrumbs fixed" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="icon-home home-icon"></i>
			<a href="{{ URL::route('principal') }}">Inicio</a>
			<span class="divider">
				<i class="icon-angle-right arrow-icon"></i>
			</span>
		</li>
		@if(isset($tituloModulo))
		<li @if(!isset($tituloSubmodulo)) class="active" @endif>
			@if(isset($tituloSubmodulo))
			<a href="{{ $rutaModulo }}">{{ $tituloModulo }}</a>
			<span class="divider">
				<i class="icon-angle-right arrow-icon"></i>
			</span>
			@else
			{{ $tituloModulo }}
			@endif
		</li>
		@endif
		@if(isset($tituloSubmodulo))
		<li class="active">{{ $tituloSubmodulo }}</li>
		@elseif(!isset($tituloModulo))
		<li class="active">Panel</li>
		@endif
	</ul><!--.breadcrumb-->
</div>