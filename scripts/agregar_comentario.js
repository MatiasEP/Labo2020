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
            
        visualizarComentarios();
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
            
            recargarComentarios();
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
    $("#inputComentario").val('');
}

function inicio()
{
    $("#agregarComentario").on("click",agregarComentario);
}