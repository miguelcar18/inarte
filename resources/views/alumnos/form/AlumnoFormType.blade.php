<div class="control-group">
	<label class="control-label" for="nombre">Nombre y apellido: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("nombre", null, ["class" => "span6", "placeholder" => "Nombre y apellido", "id" => "nombre", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="edad">Edad: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("edad", null, ["class" => "span6", "placeholder" => "Edad", "id" => "edad", 'required' => true]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="representante">Nombre del representante:</label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("representante", null, ["class" => "span6", "placeholder" => "Nombre del representante", "id" => "representante"]) }}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="banco">Banco: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{!! Form::select('banco', ["" => "Seleccione una opción", "Banco Central de Venezuela" => "Banco Central de Venezuela", "Banco de Venezuela S.A.C.A. Banco Universal" => "Banco de Venezuela S.A.C.A. Banco Universal", "Venezolano de Crédito, S.A. Banco Universal" => "Venezolano de Crédito, S.A. Banco Universal", "Banco Mercantil, C.A. Banco Universal" => "Banco Mercantil, C.A. Banco Universal", "Banco Provincial, S.A. Banco Universal" => "Banco Provincial, S.A. Banco Universal", "Bancaribe C.A. Banco Universal" => "Bancaribe C.A. Banco Universal", "Banco Exterior C.A. Banco Universal" => "Banco Exterior C.A. Banco Universal", "Banco Occidental de Descuento, Banco Universal C.A" => "Banco Occidental de Descuento, Banco Universal C.A", "Banco Caroní C.A. Banco Universal" => "Banco Caroní C.A. Banco Universal", "Banesco Banco Universal S.A.C.A." => "Banesco Banco Universal S.A.C.A.", "Banco Sofitasa, Banco Universal" => "Banco Sofitasa, Banco Universal", "Banco Plaza, Banco Universal" => "Banco Plaza, Banco Universal", "Banco de la Gente Emprendedora C.A" => "Banco de la Gente Emprendedora C.A", "BFC Banco Fondo Común C.A. Banco Universal" => "BFC Banco Fondo Común C.A. Banco Universal", "100% Banco, Banco Universal C.A." => "100% Banco, Banco Universal C.A.", "DelSur Banco Universal C.A." => "DelSur Banco Universal C.A.", "Banco del Tesoro, C.A. Banco Universal" => "Banco del Tesoro, C.A. Banco Universal", "Banco Agrícola de Venezuela, C.A. Banco Universal" => "Banco Agrícola de Venezuela, C.A. Banco Universal", "Bancrecer, S.A. Banco Microfinanciero" => "Bancrecer, S.A. Banco Microfinanciero", "Mi Banco, Banco Microfinanciero C.A." => "Mi Banco, Banco Microfinanciero C.A.", "Banco Activo, Banco Universal" => "Banco Activo, Banco Universal", "Bancamica, Banco Microfinanciero C.A." => "Bancamica, Banco Microfinanciero C.A.", "Banco Internacional de Desarrollo, C.A. Banco Universal" => "Banco Internacional de Desarrollo, C.A. Banco Universal", "Banplus Banco Universal, C.A" => "Banplus Banco Universal, C.A", "Banco Bicentenario del Pueblo de la Clase Obrera, Mujer y Comunas B.U." => "Banco Bicentenario del Pueblo de la Clase Obrera, Mujer y Comunas B.U.", "Novo Banco, S.A. Sucursal Venezuela Banco Universal" => "Novo Banco, S.A. Sucursal Venezuela Banco Universal", "Banco de la Fuerza Armada Nacional Bolivariana, B.U." => "Banco de la Fuerza Armada Nacional Bolivariana, B.U.", "Citibank N.A." => "Citibank N.A.", "Banco Nacional de Crédito, C.A. Banco Universal" => "Banco Nacional de Crédito, C.A. Banco Universal", "Instituto Municipal de Crédito Popular" => "Instituto Municipal de Crédito Popular"], null, ['id' => 'banco', 'class' => 'span6', 'required' => true]) !!}
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="comprobante">Número de comprobante: <small class="text-error">*</small></label>
	<div class="controls">
		<div class="span12">
			{{ Form::text("comprobante", null, ["class" => "span6", "placeholder" => "Número de comprobante", "id" => "comprobante", 'required' => true]) }}
		</div>
	</div>
</div>