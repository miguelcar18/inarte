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
            } else if (result.error) {
                setTimeout (function () {
                    $.gritter.add({
                        title: 'Error',
                        text: result.msg,
                        class_name: 'gritter-error'
                    });
                }, 1000);
                row.show();               
            } else {
                row.show();
            }
        }, 'json');
    };
});

$('form#disciplinaForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        nombre: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
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
        var formData = new FormData($("form#disciplinaForm")[0]);
        $.ajax({
            url:  $("form#disciplinaForm").attr('action'),
            type: $("form#disciplinaForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#disciplinaSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
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
                    if($("button#disciplinaSubmit").attr('data') == 1)
                        action = 'agregada';
                    else if($("button#disciplinaSubmit").attr('data') == 0)
                        action = 'actualizada';
                    alertMessage = 'Disciplina '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#disciplinaSubmit").attr('data') == 1){
                        $('form#disciplinaForm').reset();
                        $(document).find('div.success').removeClass('success');
                    }
                }
                $("button#disciplinaSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$('form#matriculaForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        nombre: {
            required: true
        },
        fechaNacimiento: {
            required: true
        },
        disciplina: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        fechaNacimiento: {
            required: 'Ingrese fecha de nacimiento'
        },
        disciplina: {
            required: 'Seleccione una disciplina'
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
        var formData = new FormData($("form#matriculaForm")[0]);
        var valid = false;
        var fecha = $("#fechaNacimiento").val().split("-")
        var hoy = new Date();
        var cumpleanos = new Date(fecha[2], fecha[1] - 1, fecha[0]);
        var ageDifMs = Date.now() - cumpleanos.getTime();
        var ageDate = new Date(ageDifMs);
        var edad = Math.abs(ageDate.getUTCFullYear() - 1970);

        if((edad < 18 && $("#cedulaRepresentante").val() == "") || (edad < 18 && $("#representante").val() == "")){
            $.gritter.add({
                title: 'Información',
                text: "Por ser menor de edad, ingrese los datos del representante",
                class_name: 'gritter-error'
            });
        }
        else if((edad > 12 && $("#cedula").val() == "")){
            $.gritter.add({
                title: 'Información',
                text: "Ingrese el número de cédula",
                class_name: 'gritter-error'
            });
        } else {
            $.ajax({
                url:  $("form#matriculaForm").attr('action'),
                type: $("form#matriculaForm").attr('method'),
                headers: {'X-CSRF-TOKEN' : token},
                data: formData,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $("button#matriculaSubmit").addClass('disabled');
                    $("button#cancelar").addClass('disabled');
                },
                success:function(response){
                    var accion = '';
                    var alertMessage = '';
                    var count = 0;

                    if(response.validations == false){
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
                        if($("button#matriculaSubmit").attr('data') == 1)
                            action = 'agregada';
                        else if($("button#matriculaSubmit").attr('data') == 0)
                            action = 'actualizada';
                        alertMessage = 'Matricula '+action+' satisfactoriamente';
                        $.gritter.add({
                            title: 'Registrado',
                            text: alertMessage,
                            class_name: 'gritter-success'
                        });
                        if($("button#matriculaSubmit").attr('data') == 1){
                            $('form#matriculaForm').reset();
                            $(document).find('div.success').removeClass('success');
                        }
                    }
                    $("button#matriculaSubmit").removeClass('disabled');
                    $("button#cancelar").removeClass('disabled');
                }
            })
        }
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
        edad: {
            required: true,
            number: true
        },
        nombre: {
            required: true
        },
        cedula: {
            required: true,
            number: true
        },
        fechaIngreso: {
            required: true
        },
        telefono: {
            required: true,
            number: true
        },
        tipo: {
            required: true
        }
    },
    messages: {
        cargo: {
            required: "Ingrese un cargo"
        },
        edad: {
            required: "Ingrese la edad", 
            number: "Ingrese solo números"
        },
        nombre: {
            required: "Ingrese un nombre"
        },
        cedula: {
            required: "Ingrese la cédula", 
            number: "Ingrese solo números"
        },
        fechaIngreso: {
            required: "Ingrese la fecha de ingreso"
        },
        telefono: {
            required: "Ingrese el número de teléfono", 
            number: "Ingrese solo números"
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
                        $(document).find('div.success').removeClass('success');
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

$('form#mensualidadForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        mes: {
            required: true
        }, 
        anio: {
            required: true, 
            number:true
        }, 
        banco: {
            required: true
        }, 
        comprobante: {
            required: true, 
            number:true
        }, 
        matricula: {
            required: true
        }
    },
    messages: {
        mes: {
            required: 'Seleccione un mes'
        }, 
        anio: {
            required: 'Ingrese un año', 
            number: 'Ingrese solo números'
        }, 
        banco: {
            required: 'Seleccione un banco'
        }, 
        comprobante: {
            required: 'Ingrese un número de comprobante', 
            number: 'Ingrese solo números'
        }, 
        matricula: {
            required: 'Seleccione un participante'
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
        var formData = new FormData($("form#mensualidadForm")[0]);
        $.ajax({
            url:  $("form#mensualidadForm").attr('action'),
            type: $("form#mensualidadForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#mensualidadSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
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
                    if($("button#mensualidadSubmit").attr('data') == 1)
                        action = 'agregada';
                    else if($("button#mensualidadSubmit").attr('data') == 0)
                        action = 'actualizada';
                    alertMessage = 'Mensualidad '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#mensualidadSubmit").attr('data') == 1){
                        $('form#mensualidadForm').reset();
                        $(document).find('div.success').removeClass('success');
                    }
                }
                $("button#mensualidadSubmit").removeClass('disabled');
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
        dirigido: {
            required: true
        },
        personal: {
            required: true
        },
        tipo: {
            required: true
        }
    },
    messages: {
        dirigido: {
            required: "Ingrese el nombre a quien va dirigido"
        },
        personal: {
            required: "Seleccione el personal que solicita la constancia"
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
                        $(document).find('div.success').removeClass('success');
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
        nombre: {
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
        nombre: {
            required: "Ingrese un nombre"
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
                        $("#tablaParticipantes tbody > tr").remove();
                        $(document).find('div.success').removeClass('success');
                        $("#participantes").find("option").prop("disabled", false);
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

$("#usuarioForm").validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
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
        password_repeat: {
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
        password_repeat: {
            required: "Confirme la contraseña ingresada",
            equalTo: "Ambas contraseñas deben ser iguales"
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
                    if($("button#usuarioSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#usuarioSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Usuario '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#usuarioSubmit").attr('data') == 1){
                        $('form#usuarioForm').reset();
                        $(document).find('div.success').removeClass('success');
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

$("#usuarioEditForm").validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
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
        var formData = new FormData($("form#usuarioEditForm")[0]);
        $.ajax({
            url:  $("form#usuarioEditForm").attr('action'),
            type: $("form#usuarioEditForm").attr('method'),
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
                    if($("button#usuarioSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#usuarioSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Usuario '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#usuarioSubmit").attr('data') == 1){
                        $('form#usuarioEditForm').reset();
                        $(document).find('div.success').removeClass('success');
                    }
                    else if($("button#usuarioSubmit").attr('data') == 0){
                        var imagenActual = $('#fotoNavbar').attr("src").split("/uploads/");
                        var ruta = imagenActual[0]+"/uploads/usuarios/"+response.photo;
                        //$('#fotoNavbar').attr("src", ruta);
                        //$('#fotoSidebar').attr("src", ruta);
                        //$('#fotoNavbar').attr("src", ruta);
                    }
                }
                $("button#usuarioSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("#changePasswordForm").validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        password_actual: {
            required: true,
            minlength: 6
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
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#changePasswordForm")[0]);
        $.ajax({
            url:  $("form#changePasswordForm").attr('action'),
            type: $("form#changePasswordForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#passwordSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var action = '';
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
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    $('form#changePasswordForm').reset();
                    $(document).find('.validation-valid-label').remove();
                }
                $("button#passwordSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$('form#eventoPrivadoForm').validate({
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
        nombre: {
            required: true
        },
        empresa: {
            required: true
        },
        disciplina: {
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
        nombre: {
            required: "Ingrese un nombre"
        },
        empresa: {
            required: "Ingrese una empresa"
        },
        disciplina: {
            required: "Seleccione una disciplina"
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
        var formData = new FormData($("form#eventoPrivadoForm")[0]);
        $.ajax({
            url:  $("form#eventoPrivadoForm").attr('action'),
            type: $("form#eventoPrivadoForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#eventoPrivadoSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(response){
                var accion = '';
                var alertMessage = '';
                var count = 0;

                if(response.validations == false){
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
                    if($("button#eventoPrivadoSubmit").attr('data') == 1)
                        action = 'agregado';
                    else if($("button#eventoPrivadoSubmit").attr('data') == 0)
                        action = 'actualizado';
                    alertMessage = 'Evento privado '+action+' satisfactoriamente';
                    $.gritter.add({
                        title: 'Registrado',
                        text: alertMessage,
                        class_name: 'gritter-success'
                    });
                    if($("button#eventoPrivadoSubmit").attr('data') == 1){
                        $('form#eventoPrivadoForm').reset();
                        $("#tablaParticipantes tbody > tr").remove();
                        $(document).find('div.success').removeClass('success');
                        $("#participantes").find("option").prop("disabled", false);
                    }
                }
                $("button#eventoPrivadoSubmit").button('reset');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
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
                        $(document).find('div.success').removeClass('success');
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
                        $(document).find('div.success').removeClass('success');
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
                        $(document).find('div.success').removeClass('success');
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

$('form#morososMensualidadForm').validate({
    errorElement: 'span',
    errorClass: 'help-inline',
    focusInvalid: false,
    rules: {
        mes: {
            required: true
        }, 
        anio: {
            required: true, 
            number:true
        }, 
        disciplina: {
            required: true
        }
    },
    messages: {
        mes: {
            required: 'Seleccione un mes'
        }, 
        anio: {
            required: 'Ingrese un año', 
            number: 'Ingrese solo números'
        }, 
        disciplina: {
            required: 'Seleccione una disciplina'
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
        var formData = new FormData($("form#morososMensualidadForm")[0]);
        $.ajax({
            url:  $("form#morososMensualidadForm").attr('action'),
            type: $("form#morososMensualidadForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#morososMensualidadSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(respuesta){
                tablaData.fnClearTable();
                respuesta.respuesta.forEach(function(element) {
                    if(element.banco == null){
                        tablaData.fnAddData([
                            element.cedula, 
                            element.nombre, 
                            element.disciplina
                        ]);
                    }
                });
                $("button#morososMensualidadSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    },
    invalidHandler: function (form) {
    }
});

$("select.selectDisciplinas").on("change", function(){
    var selectselectDisciplinas = $(this);
    var valor = $(this).val();
    var url = 'http://'+window.location.host+"/inarte" + '/selectDisciplina/' + valor;
    if(valor){
        $.ajax({
            url: url,
            method: "GET",
            data: { _token: $('input[name=token]').val() },
            dataType: 'json',
            success: function(respuesta){
                if(respuesta.correcto){
                    $("#tablaParticipantes tbody > tr").remove();
                    var selectMatriculas = '<select id="participantes" class="span6" name="participantes">';
                    selectMatriculas+='<option value="">Seleccione</option>';
                    $.each(respuesta.matriculas , function(i, val){
                        selectMatriculas+= '<option value="'+i+'">'+val+'</option>';
                    });
                    selectMatriculas+='</select>';
                    $('#participantes').empty();
                    $('#participantes').html(selectMatriculas);
                } else {
                    console.log('Sin exito');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                if(jqXHR){
                    console.log(jqXHR);
                }
            }
        });
    }
}).change();

function eliminarFila(fila) {
    var valor = fila.parentNode.previousSibling.childNodes[0].value;
    $("#participantes").find("option[value='"+valor+"']").prop("disabled", false);
    fila.parentNode.parentNode.remove();
}

function eliminarFilaEditar(fila) {
    var valor = fila.parentNode.previousSibling.previousSibling.childNodes[1].value;
    $("#participantes").find("option[value='"+valor+"']").prop("disabled", false);
    fila.parentNode.parentNode.remove();
}

function agregarValor() {
    var tabla = document.getElementById("tablaParticipantes").tBodies[0];
    var participante = document.getElementById("participantes").value;
    var combo = document.getElementById("participantes");
    var selected = combo.options[combo.selectedIndex].text;

    if(participante == "") {
        $.gritter.add({
            title: 'Información',
            text: "Seleccione un participante",
            class_name: 'gritter-info'
        });
    }
    else {
        var fila = tabla.insertRow(-1);
        var celda0 = fila.insertCell(0);
        var celda1 = fila.insertCell(1);

        celda0.innerHTML = '<input type="hidden" name="matriculaA[]" id="matriculaA[]" value="'+participante+'" />'+selected;
        celda1.innerHTML = '<button type="button" onclick="eliminarFila(this)" class="btn btn-mini btn-danger"><i class="icon-trash bigger-120"></i></button>';
        $("#participantes").find(":selected").prop("disabled", true);
        $('#participantes').val('');
    }
}