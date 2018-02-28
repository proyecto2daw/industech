$(document).ready(function(){
    $('#formIncidencia').submit(function(e){
        e.preventDefault();
        var datos=$(this).serialize();
        $.ajax({
            url:'index.php?controller=incidencia&action=crear',
            method:'POST',
            data:datos,
            success:function(data){
                alert(data);
            }
        });
    });
});