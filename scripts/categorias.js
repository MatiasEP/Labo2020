$(document).ready(inicio)

function mostrarCategorias()
{
    let request = $.ajax(
    {
        method: "POST",
        url: "../json/categorias.json"
    });
        request.done(function(data) { 
        for(let j = 0; j<data.length ; j++)
        {
            $(".closebtn").after("<a href=./mostrar%20recetas%20por%20tipo.php?categoria="+data[j]["nombre"]+">"+data[j]["nombre"]+"</a>\n");
        }
    });
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function inicio()
{
    mostrarCategorias();
}