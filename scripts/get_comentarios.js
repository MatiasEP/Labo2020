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
            $("#divComentarios").append("<div >"+
            "<img class='img-circle perfil chat_pic' src='"+data[i]["usuario"][0]["picture"]+"'>"+
            "<a href='../paginas/mostrar%20recetas%20por%20usuario.php?id="+Object.values(data[i]["idUsuario"])+"'>"+
            data[i]["usuario"][0]["nombre"]+"</a>"+" : "+data[i]["texto"]+"<br><br></div>")
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