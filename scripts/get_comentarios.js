$(document).ready(inicio)

function visualizarComentarios()
{
    let request = $.ajax(
    {
        method: "POST",
        url: "../json/comentarios.json"
    });
        request.done(function(data) {  
        for(let i = 0; i<data.length;i++)
        {            
            $("#comentarios").append(data[i]["usuario"][0]["nombre"]+" : "+data[i]["texto"]+"<br><br>")
        }
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function inicio()
{
    visualizarComentarios();
}