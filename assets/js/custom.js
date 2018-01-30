$.fn.reset = function () {
    $(this).each (function() { this.reset(); });
}

function decision(message, url){
    if(confirm(message)) location.href = url;
}
function confirmSubmit(form, message) { 
    var agree=confirm(message);
    if (agree) {
        form.submit();
        return false;
    } else {
        return false;
    }
}

var tablaData = $('.datatable-basic').DataTable({
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

$('.tooltip-error').click(function (e) {
    e.preventDefault();
    var message = "¿Está realmente seguro(a) de eliminar este registro?";
    var id = $(this).data('id');
    var form = $('#form-delete');
    var action = form.attr('action').replace('USER_ID', id);
    var row =  $(this).parents('tr');
    if(confirm(message)){
        $.post(action, form.serialize(), function(result) {
            if (result.success) {
                row.fadeOut(1000);
                setTimeout (function () {
                    row.delay(1000).remove();
                    $.gritter.add({
                        title: 'Eliminado',
                        text: result.msg,
                        class_name: 'gritter-success'
                    });
                }, 1000);                
            }
            else if (result.error) {
                setTimeout (function () {
                    $.gritter.add({
                        title: 'Error',
                        text: result.msg,
                        class_name: 'gritter-error'
                    });
                }, 1000);
                row.show();               
            } 
            else{
                row.show();
            }
        }, 'json');
    };
});

$("#usuarioForm").validate({
    ignore: 'input[type=hidden], .select2-search__field', 
    errorClass: 'validation-error-label',
    successClass: 'validation-valid-label',
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    unhighlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    },
    errorPlacement: function(error, element) {
        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent().parent().parent() );
            }
            else {
                error.appendTo( element.parent().parent().parent().parent().parent() );
            }
        }
        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
            error.appendTo( element.parent().parent().parent() );
        }
        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
            error.appendTo( element.parent() );
        }
        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
            error.appendTo( element.parent().parent() );
        }
        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
            error.appendTo( element.parent().parent() );
        }
        else {
            error.insertAfter(element);
        }
    },
    validClass: "validation-valid-label",
    success: function(label) {
        label.addClass("validation-valid-label").text("Correcto.")
    },
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        username: {
            required: true
        },
        rol: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        },
        repeatPassword: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        name: {
            required: "Ingrese un nombre y apellido"
        },
        email: {
            required: "Ingrese un emal",
            email: "Ingrese un email válido"
        },
        username: {
            required: "Ingrese un nombre de usuario"
        },
        rol: {
            required: "Seleccione un rol"
        },
        password: {
            required: "Ingrese una contraseña",
            minlength: "Ingrese una contraseña con al menos 6 caracteres"
        },
        repeatPassword: {
            required: "Confirme la contraseña ingresada",
            equalTo: "Ambas contraseñas deben ser iguales"
        }
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#usuarioForm")[0]);
        $.ajax({
            url:  $("form#usuarioForm").attr('action'),
            type: $("form#usuarioForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#usuarioSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var action = '';
                var alertMessage = '';
                var count = 0;
                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "information",
                        dismissQueue: true,
                        timeout: 10000,
                        layout: "topRight",
                        buttons: false
                    });
                }
                else if(response.validations == true){
                    if($("button#usuarioSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#usuarioSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Usuario '+action+' satisfactoriamente';
                    noty({
                        width: 200,
                        text: alertMessage,
                        type: "success",
                        dismissQueue: true,
                        timeout: 4000,
                        layout: "topCenter",
                        buttons: false
                    });
                    if($("button#usuarioSubmit").attr('data') == 1){
                        $('form#usuarioForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                    else if($("button#usuarioSubmit").attr('data') == 0){
                        var imagenActual = $('#fotoActual').attr("src").split("/uploads/");
                        var ruta = imagenActual[0]+"/uploads/usuarios/"+response.photo;
                        $('#fotoActual').attr("src", ruta);
                        $('#fotoSidebar').attr("src", ruta);
                        $('#fotoNavbar').attr("src", ruta);
                        console.log(response);
                    }
                }
                $("button#usuarioSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("#formLogin").validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        username: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        }
    },
    messages: {
        username: {
            required: "Ingrese un nombre de usuario"
        },
        password: {
            required: "Ingrese una contraseña",
            minlength: "Debe ingresar al menos 6 caracteres"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#formLogin")[0]);
        $.ajax({
            url:  $("form#formLogin").attr('action'),
            type: $("form#formLogin").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#loginButton").addClass('disabled');
            },
            success:function(response){
                var alertMessage = 'Usuario o contraseña incorrectos';
                if(response.message == "error"){
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                    $('button#loginButton').removeClass('disabled');
                } else{
                    window.location = 'http://'+window.location.host+"/inarte";
                }
            }
        })
        return false;
    }
});

$('form#mensualidadForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        password_actual: {
            required: true
        },
        password: {
            required: true,
            minlength: 6
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        }
    },
    messages: {
        password_actual: {
            required: 'Ingrese su contraseña actual'
        },
        password: {
            required: "Ingrese su nueva contraseña",
            minlength: jQuery.validator.format("Debe ingresar al menos {0} caracteres")
        },
        password_confirmation: {
            required: 'Repita la nueva contraseña',
            equalTo: 'Las contraseñas deben de ser iguales'
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#passwordForm")[0]);
        $.ajax({
            url:  $("form#passwordForm").attr('action'),
            type: $("form#passwordForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#passwordSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.message == "error"){
                    $.gritter.add({
                        title: 'Información',
                        text: 'La contraseña acutal ingresada es incorrecta.',
                        class_name: 'gritter-error'
                    });
                }
                else if(response.message == "correcto"){
                    action = 'actualizada';
                    alertMessage = 'Contraseña '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Información',
                        text: 'La contraseña acutal ingresada es incorrecta.',
                        class_name: 'gritter-success'
                    });
                    $('form#passwordForm').reset();
                    $(document).find('.validation-valid-label').remove();
                }
                $("button#passwordSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#constanciaForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        cedula: {
            required: true,
            number: true
        },
        nombre: {
            required: true
        },
        dirigido: {
            required: true
        },
        tiempo: {
            required: true
        },
        telefono: {
            required: true
        },
        tipo: {
            required: true
        }
    },
    messages: {
        cedula: {
            required: "Ingrese un número de cédula",
            number: "Ingrese solo números"
        },
        nombre: {
            required: "Ingrese un nombre"
        },
        dirigido: {
            required: "Ingrese el nombre a quien va dirigido"
        },
        tiempo: {
            required: "Ingrese el tiempo que tiene en la empresa"
        },
        telefono: {
            required: "Ingrese el número de teléfono"
        },
        tipo: {
            required: "Seleccione el tipo de constancia"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#constanciaForm")[0]);
        $.ajax({
            url:  $("form#constanciaForm").attr('action'),
            type: $("form#constanciaForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#constanciaSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#constanciaSubmit").attr('data') == 1)
                        action = 'agregada';
                    else if($("button#constanciaSubmit").attr('data') == 0)
                        action = 'actualizada';
                    alertMessage = 'Constancia '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#constanciaSubmit").attr('data') == 1){
                        $('form#constanciaForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#constanciaSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#personalForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        cargo: {
            required: true
        },
        nombre: {
            required: true
        },
        edad: {
            required: true
        },
        tiempo: {
            required: true
        },
        telefono: {
            required: true
        },
        tipo: {
            required: true
        }
    },
    messages: {
        cargo: {
            required: "Ingrese un cargo"
        },
        nombre: {
            required: "Ingrese un nombre"
        },
        edad: {
            required: "Ingrese la edad"
        },
        tiempo: {
            required: "Ingrese el tiempo que tiene en la empresa"
        },
        telefono: {
            required: "Ingrese el número de teléfono"
        },
        tipo: {
            required: "Seleccione el tipo de personal"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#personalForm")[0]);
        $.ajax({
            url:  $("form#personalForm").attr('action'),
            type: $("form#personalForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#personalSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#personalSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#personalSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Personal '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#personalSubmit").attr('data') == 1){
                        $('form#personalForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#personalSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#eventoForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        fecha: {
            required: true
        },
        lugar: {
            required: true
        },
        participantes: {
            required: true
        }
    },
    messages: {
        fecha: {
            required: "Ingrese una fehca"
        },
        lugar: {
            required: "Ingrese un lugar"
        },
        participantes: {
            required: "Ingrese los participantes"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#eventoForm")[0]);
        $.ajax({
            url:  $("form#eventoForm").attr('action'),
            type: $("form#eventoForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#eventoSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#eventoSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#eventoSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Evento '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#eventoSubmit").attr('data') == 1){
                        $('form#eventoForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#eventoSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#cursoForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        curso: {
            required: true
        },
        lugar: {
            required: true
        },
        horario: {
            required: true
        },
        profesor: {
            required: true
        }
    },
    messages: {
        curso: {
            required: "Ingrese un curso"
        },
        lugar: {
            required: "Ingrese un lugar"
        },
        horario: {
            required: "Ingrese el horario"
        },
        profesor: {
            required: "Ingrese el profesor"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#cursoForm")[0]);
        $.ajax({
            url:  $("form#cursoForm").attr('action'),
            type: $("form#cursoForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#cursoSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#cursoSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#cursoSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Curso '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#cursoSubmit").attr('data') == 1){
                        $('form#cursoForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#cursoSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#horarioForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        horario: {
            required: true
        },
        profesor: {
            required: true
        }
    },
    messages: {
        horario: {
            required: "Ingrese el horario"
        },
        profesor: {
            required: "Ingrese el profesor"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#horarioForm")[0]);
        $.ajax({
            url:  $("form#horarioForm").attr('action'),
            type: $("form#horarioForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#horarioSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#horarioSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#horarioSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Horario '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#horarioSubmit").attr('data') == 1){
                        $('form#horarioForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#horarioSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#sugerenciaForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        nombre: {
            required: true
        },
        sugerencia: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: "Ingrese un nombre"
        },
        sugerencia: {
            required: "Ingrese la sugerencia u opinión"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#sugerenciaForm")[0]);
        $.ajax({
            url:  $("form#sugerenciaForm").attr('action'),
            type: $("form#sugerenciaForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#sugerenciaSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#sugerenciaSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#sugerenciaSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Sugerencia '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#sugerenciaSubmit").attr('data') == 1){
                        $('form#sugerenciaForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#sugerenciaSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#alumnoForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        edad: {
            required: true,
            number: true
        },
        nombre: {
            required: true
        },
        comprobante: {
            required: true
        },
        banco: {
            required: true
        }
    },
    messages: {
        edad: {
            required: "Ingrese una edad",
            number: "Ingrese solo números"
        },
        nombre: {
            required: "Ingrese un nombre"
        },
        comprobante: {
            required: "Ingrese el número de comprobante"
        },
        banco: {
            required: "Seleccione el tipo de constancia"
        }
    },
    invalidHandler: function (event, validator) { //display error alert on form submit   
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.control-group').removeClass('info').addClass('error');
    },

    success: function (e) {
        $(e).closest('.control-group').removeClass('error').addClass('success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function (form) {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#alumnoForm")[0]);
        $.ajax({
            url:  $("form#alumnoForm").attr('action'),
            type: $("form#alumnoForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#alumnoSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
                    //alertMessage = "<b>Campos únicos:</b> <br>";
                    $.each(response.errors, function(index, value){
                        count++;
                        alertMessage+= count+". "+value+"<br>";
                    });
                    $.gritter.add({
                        title: 'Información',
                        text: alertMessage,
                        class_name: 'gritter-error'
                    });
                }
                else if(response.validations == true){
                    if($("button#alumnoSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#alumnoSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Alumno '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#alumnoSubmit").attr('data') == 1){
                        $('form#alumnoForm').reset();
                        $(document).find('.validation-valid-label').remove();
                    }
                }
                $("button#alumnoSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});