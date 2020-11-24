$(document).ready(inicio)



function recargarComentarios()
{
    
    let params = new URLSearchParams(location.search);
    let idReceta = params.get('id');
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
    let params = new URLSearchParams(location.search);
    let idReceta = params.get('id');
    let comentario = $("#inputComentario").val();
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
       let parametros = {
        "idReceta" : idReceta,
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