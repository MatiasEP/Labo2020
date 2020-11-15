$(document).ready(inicio)



function recargarComentarios()
{
    let idReceta = "5fa58577bd0d000028004567"//temporal para test
    let parametros = {
        "id" : idReceta
    };
    let request = $.ajax(
        {
            data: parametros,
            method: "GET",
            url: "../php/get_comentarios.php"
        });
            request.done(function(data) {  
            
        setTimeout(visualizarComentarios(),5000);
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function agregarComentario()
{
    let comentario = $("#inputComentario").val();
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
       let parametros = {
        /*"idUsuario" : $idUsuario,
        "idReceta" : $idReceta,*/
        "comentario": comentario
    };
    let request = $.ajax(
        {
            data: parametros,
            method: "POST",
            url: "../php/agregar_comentario.php"
        });
            request.done(function(data) {  
            
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
    setTimeout(recargarComentarios,200);
    $("#inputComentario").val('');
}

function inicio()
{
    $("#agregarComentario").on("click",agregarComentario);
}