$(document).ready(inicio)

function mostrarCategorias()
{
    let request = $.ajax(
    {
        method: "POST",
        url: "../php/get_categorias.php"
    });
        request.done(function(data) { 
        for(let j = 0; j<data.length ; j++)
        {
            let categoria = data[j]["nombre"];
            $(".closebtn").after("<a href=./mostrar%20recetas%20por%20tipo.php?categoria="+categoria.replace(/ /g, '%20')+">"+categoria+"</a>\n");
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