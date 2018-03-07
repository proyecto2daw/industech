$(document).ready(function () {

    $.ajax({
        url: 'index.php?controller=incidencia&action=datosModalCategoria',
        method: 'POST',
        success: function (data) {
            var datosModal = jQuery.parseJSON(data);
            //$('#inputCategoria').empty();
            $('#inputCategoria').append('<option >Seleccione opcion</option>');
            $.each(datosModal, function (key, item) {
                $('#inputCategoria').append('<option value="' + item.idCategoria + '">' + item.nombre + '</option>');
            });
        }
    });

    $.ajax({
        url: 'index.php?controller=incidencia&action=datosModalTecnico',
        method: 'POST',
        success: function (data) {
            var datosModal = jQuery.parseJSON(data);
            //$('#inputTecnico').empty();
            $('#inputTecnico').append('<option >Seleccione opcion</option>');
            $.each(datosModal, function (key, item) {
                $('#inputTecnico').append('<option value="' + item.idUsuario + '">' + item.nombre + '</option>');
            });
        }
    });


    $.ajax({
        url: 'index.php?controller=incidencia&action=datosModalEmpresa',
        method: 'POST',
        success: function (data) {
            var datosModal = jQuery.parseJSON(data);
            //$('#inputEmpresa').empty();
            $('#inputEmpresa').append('<option >Seleccione opcion</option>');
            $.each(datosModal, function (key, item) {
                $('#inputEmpresa').append('<option value="' + item.idEmpresa + '">' + item.nombre + '</option>');
            });
        }
    });


    $('[name="empresa"]').change(function () {
        $('[name="contacto"]').removeAttr('disabled');
        var idEmpresa = $(this).val();
        $.ajax({
            url: 'index.php?controller=incidencia&action=datosModalContacto&idEmpresa=' + idEmpresa,
            method: 'GET',
            success: function (data) {
                var datosModal = jQuery.parseJSON(data);
                $('[name="contacto"]').empty();
                $('[name="contacto"]').append('<option >Seleccione opcion</option>');
                $.each(datosModal, function (key, item) {
                    $('[name="contacto"]').append('<option value="' + item.idEmpleado + '">' + item.nombre + '</option>');
                });
            }
        });


    });


    $(".modal").on("hidden.bs.modal", function () {
        $("#formIncidencia").trigger("reset");
        ;
        $('[name="contacto"]').prop("disabled", true);
        $('[name="contacto"]').empty();
    });



    $('#formIncidencia').validetta({
        realTime: true,
        display: 'bubble',
        bubblePosition: 'right', // Bubble position // right / bottom
        bubbleGapLeft: 50,
        onValid: function (e) {
            e.preventDefault();
            var datos = $('#formIncidencia').serialize();
            console.log(datos);
            $.ajax({
                url: 'index.php?controller=incidencia&action=crear',
                method: 'POST',
                data: datos,
                success: function (data) {
                    console.log(data);
                    if (data != 0 && data != 'ok') {
                        alertify.success("insertado con exito");
                        $('#tablaIncidencias').prepend('<tr>\n\
                                                            <th scope="row">' + $('[name="titulo"]').val() + '</th>\n\
                                                            <td>ahora</td>\n\
                                                            <td>'+ $('[name="categoria"]').val()+'</td>\n\
                                                             \n\
                                                            <td class="d-flex justify-content-end">\n\
                                                                <a class="btn btn-info" href="index.php?controller=incidencia&action=ver&id=' + data + '" title="ver incidencia" ><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;'+
                                                                '<button class="btn btn-primary bcerrar" title="cerrar incidencia" value="' + data + '"><i class="fas fa-lock"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;'+                                                                
                                                                '<button class="btn btn-danger borrar" title="borrar incidencia" value="' + data + '"><i class="fas fa-trash-alt"></i></button>'+         
                                                           ' </td></tr>');
                    }
                    else if(data=='ok'){
                        alertify.success("insertado con exito");
                }
            }});
        }
    });
    
    
    $('body').on('click','.borrar',function(){
        var estado = 2;
        var idIncidencia = $(this).val();
        var boton=$(this);
        var url='index.php?controller=incidencia&action=borradoLogico&id=' + idIncidencia + '&es=' + estado;
        
        $.ajax({
            url: url,            
            success: function (data) {
                resultado=data;
                if(resultado == 1) {
                    boton.parent().parent().remove();
                }
                else {
                    alertify.error('No se ha podido cerrar la Incidencia');
                }
            }
        });
    });
    
    $('body').on('click','.bcerrar',function(){
        var estado = 1;
        var idIncidencia = $(this).val();
        var boton=$(this);
        var url='index.php?controller=incidencia&action=borradoLogico&id=' + idIncidencia + '&es=' + estado;
        
        $.ajax({
            url: url,            
            success: function (data) {
                console.log(data);
                resultado=data;
                if(resultado == 1) {
                 boton.toggleClass('btn-primary btn-secondary');
                       boton.attr('disabled','disabled');
                }
                else {
                    alertify.error('No se ha podido borrar la Incidencia2');
                }
            }
        });
    });
    $('body').on('click','.cerrar',function(){
        var estado = 1;
        var idIncidencia = $(this).val();
        
        var url='index.php?controller=incidencia&action=borradoLogico&id=' + idIncidencia + '&es=' + estado;
        
        $.ajax({
            url: url,            
            success: function (data) {
                resultado=data;
                if(resultado == 1) {
                    location.replace('index.php');
                }
                else {
                    alert('No se ha podido cerrar la Incidencia');
                }
            }
        });
    });
});
