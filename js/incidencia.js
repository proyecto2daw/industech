
$(document).ready(function () {
    
    
    $.ajax({
        url: 'index.php?controller=incidencia&action=datosModalCategoria',
        method: 'POST',
        success: function (data) {
            var datosModal = jQuery.parseJSON(data);
            $.each(datosModal, function (key, item) {
                if(item.idCategoria == $('#categoriaActual').val()) {
                    $('#inputCategoriaModificar').append('<option value="' + item.idCategoria + '" selected>' + item.nombre + '</option>');
                }
                if(item.idCategoria != $('#categoriaActual').val()) {
                    $('#inputCategoriaModificar').append('<option value="' + item.idCategoria + '">' + item.nombre + '</option>');
                }
            });
        }
    });
    
    $.ajax({
        url: 'index.php?controller=incidencia&action=datosModalTecnico',
        method: 'POST',
        success: function (data) {
            var datosModal = jQuery.parseJSON(data);
            $.each(datosModal, function (key, item) {
                if(item.idUsuario == $('#tecnicoActual').val()) {
                    $('#inputTecnicoModificar').append('<option value="' + item.idUsuario + '" selected>' + item.nombre + '</option>');
                }
                if(item.idUsuario != $('#tecnicoActual').val()) {
                    $('#inputTecnicoModificar').append('<option value="' + item.idUsuario + '">' + item.nombre + '</option>');
                }
            });
        }
    });
    
    $.ajax({
        url: 'index.php?controller=incidencia&action=datosModalContacto&idEmpresa=' + $('#empresaModificar').val(),
        method: 'GET',
        success: function (data) {
            console.log(data);
            var datosModal = jQuery.parseJSON(data);
            $.each(datosModal, function (key, item) {
                if(item.idEmpleado == $('#contactoActual').val()) {
                    $('#inputContactoModificar').append('<option name="contactoOption" value="' + item.idEmpleado + '" selected>' + item.nombre + '</option>');                    
                }
                if(item.idEmpleado != $('#contactoActual').val()) {
                    $('#inputContactoModificar').append('<option name="contactoOption" value="' + item.idEmpleado + '">' + item.nombre + '</option>');
                }
            });
        }
    });
    
    $('#btnActivarModificar').click(function() {
        $('.camposFormModificar').prop("disabled", false);
        $('#btnActivarModificar').prop("hidden", true);
        $('#btnGuardarModificar').prop("hidden", false);
        $('#btnCerrarIncidencia').prop("hidden", true);
        $('#btnCancelarModificar').prop("hidden", false);
    });
    
    
    $('#inputContactoModificar').change(function() {
        var url='index.php?controller=empleado&action=datosEmpleado&id=' +$("#inputContactoModificar").val();
       
        $.ajax({
            url: url,
            
            success: function (data) {
                console.log(data);
              var jsonData=JSON.parse(data);
                
                var telefonoContacto =jsonData.telefono;          
                $('#telContacto').attr('value', telefonoContacto);
                
                /*var datosModal = jQuery.parseJSON(data);
                $.each(datosModal, function (key, item) {
                    if (item.idEmpleado == $('#contactoActual').val()) {
                        $('#inputContactoModificar').append('<option value="' + item.idEmpleado + '" selected>' + item.nombre + '</option>');
                    }
                    if (item.idEmpleado != $('#contactoActual').val()) {
                        $('#inputContactoModificar').append('<option value="' + item.idEmpleado + '">' + item.nombre + '</option>');
                    }
                });*/
                
            }
        });
        
        //$('#telContacto').attr('value', item.telefono); 
        //$('#telContacto').attr('placeholder', item.telefono); 
        
        
        /*contactoActual
        
        Object.keys(jsonData['telefono'])*/
    });
    
    $('#btnCancelarModificar').click(function(event) {
        $('#editarIncidenciaForm')[0].reset();        
        $('.camposFormModificar').prop("disabled", true);
        $('#btnCancelarModificar').prop("hidden", true);
        $('#btnCerrarIncidencia').prop("hidden", false);
        $('#btnGuardarModificar').prop("hidden", true);
        $('#btnActivarModificar').prop("hidden", false);        
    });
    
    $('#formSeguimiento').validetta({
        realTime: true,
        display: 'bubble',
        bubblePosition: 'right', // Bubble position // right / bottom
        bubbleGapLeft: 50,
        onValid: function (e) {
            e.preventDefault();
            var datos = $('#formSeguimiento').serialize();
         
            $.ajax({
                url: 'index.php?controller=incidencia&action=seguimientoIncidencia',
                method: 'POST',
                data: datos,
                success: function (data) {
                    console.log(data)
                    if (data != 0) {
                        alertify.success("insertado con exito");
                    } else {
                        alertify.error("error");
                    }
                }
            });
        }
    });

});



