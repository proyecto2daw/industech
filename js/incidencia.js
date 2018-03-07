
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
    
        $('#cerrarIncidencia').prop("hidden", true);
        $('#btnGuardarModificar').prop("hidden", false);        
        $('#btnCancelarModificar').prop("hidden", false);    $('#btnCancelarModificar').addClass('bcancelar');
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
            }
        });
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
                    if (data!=0 && !isNaN(data)) {
                        alertify.success("insertado con exito");
                        $('#bodySeguimientos').prepend('<tr><th scope="row">ahora</th><td>'+$('[name="descripcionSeguimiento"]').val()+'</td><td>yo</td></tr>')
                        $('#anadirSeguimiento').modal('hide');
                    } else {
                        alertify.error("error");
                    }
                }
            });
        }
    });    
    
    $('#btnCerrarIncidencia').click(function() {
        var estado = 1;
        var idIncidencia = $('#idIncidencia').val();
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
    
    $('#btnGuardarModificar').click(function() {
        $('#editarIncidenciaForm').attr('action', 'index.php?controller=incidencia&action=update&id=' + $('#idIncidencia').val());
    });

});



