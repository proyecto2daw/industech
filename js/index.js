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


    $('#inputEmpresa').change(function () {
        $('#inputContacto').removeAttr('disabled');
        var idEmpresa = $(this).val();
        $.ajax({
            url: 'index.php?controller=incidencia&action=datosModalContacto&idEmpresa=' + idEmpresa,
            method: 'GET',
            success: function (data) {
                console.log(data);
                var datosModal = jQuery.parseJSON(data);
                $('#inputContacto').empty();
                $('#inputContacto').append('<option >Seleccione opcion</option>');
                $.each(datosModal, function (key, item) {
                    $('#inputContacto').append('<option value="' + item.idEmpleado + '">' + item.nombre + '</option>');
                });
            }
        });
    });


});

$('#formIncidencia').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var datos = form.serialize();
    $.ajax({
        url: form.atrr('action'),
        method: 'POST',
        data: datos,
        success: function (data) {
            alert(data);
        }
    });

});

