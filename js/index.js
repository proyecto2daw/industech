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
                                                            <td>{{incidencia.descripcion}}</td><td>{{incidencia.fecha}}</td>\n\
                                                            <td>{{incidencia.nombreCategoria}}</td> \n\
                                                            <td><a class="btn btn-primary" href="index.php?controller=incidencia&action=ver&id=' + data + '" title="ver incidencia" ><i class="fa fa-eye"></i></a></td>\n\
                                                        </tr>');
                    }
//                    else {
//                        alertify.error("error");
//                    }
                }
            });
        }
    });
    
    $('.cerrar').click(function(){
        var estado = 1;
        var idIncidencia = $(this).val();       
        var url='index.php?controller=incidencia&action=cerrar&id=' + idIncidencia + '&es=' + estado;
        
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
    
    $('.borrar').click(function(){
        var estado = 2;
        var idIncidencia = $(this).val();
        
        //alert('idIncidencia---> ' + idIncidencia);
        
        var url='index.php?controller=incidencia&action=borradoLogico&id=' + idIncidencia + '&es=' + estado;
        
        $.ajax({
            url: url,            
            success: function (data) {
                resultado=data;
                if(resultado == 1) {
                    location.replace('index.php');
                }
                else {
                    alert('No se ha podido borrar la Incidencia');
                }
            }
        });
    });
    
    $('#todasIncidenciasTable').tablesorter(); 

});
