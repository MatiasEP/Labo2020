$(document).ready(inicio)

function visualizarComentarios()
{
    let params = new URLSearchParams(location.search);
    var idUrl = params.get('id');
    let request = $.ajax(
    {
        method: "GET",
        url: "../php/get_comentarios.php",
        data: { 
            id: idUrl,
          }
    });
        request.done(function(data) {  
            $("#divComentarios").empty();
        for(let i = 0; i<data.length;i++)
        {            
            $("#divComentarios").append(data[i]["usuario"][0]["nombre"]+" : "+data[i]["texto"]+"<br><br>")
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