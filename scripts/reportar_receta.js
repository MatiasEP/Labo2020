$(document).ready(inicio)


function enviarReporte()
{
    let reporte = $("#reporte").val();
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
       let parametros = {
        /*"idUsuario" : $idUsuario,
        "idReceta" : $idReceta,*/
        "reporte": reporte
    };
    let request = $.ajax(
        {
            data: parametros,
            method: "POST",
            url: "../php/agregar_reporte.php"
        });
            request.done(function(data) {  
            
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function ocultarModal()
{    
    $('#myModal').modal('hide');
}

function inicio()
{
    $("#formReporte").on('submit',function(event)
    {
        event.preventDefault();
        enviarReporte(); 
        setTimeout(ocultarModal, 200);
    });
}