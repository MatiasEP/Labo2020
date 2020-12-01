$(document).ready(inicio)


function mostrarTodosLosSeguidos()
{
    let params= new URLSearchParams(location.search);
    var busqueda = params.get('id');
    let request = $.ajax(
    {
        method: "GET",
        url: "../php/mostrar seguidos.php",
        data: { 
            id: busqueda,
          }
    });
        $("#main").empty();
        request.done(function(data) {  
        $("#main").append(  "<h1>Resultados<h1><br><br>");       
        for(let i = 0; i<data.length;i++)
        {
            $("#main").append("<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>"+
            "<div class='panel panel-primary' >"+   
            "<div class='panel-heading'>"+data[i]["nombre"]+"</div>"+
            "<div class='panel-body' >"+       
            "<img src="+(data[i]["picture"]).replace(/ /g, '%20')+" class='thumbnail' alt='preview'>"+
            "<div class='panel-footer verReporte' ><a class='btn btn-primary' href='../paginas/mostrar%20recetas%20por%20usuario.php?id="+(Object.values(data[i]["_id"]))[0]+"'>"+
            "<span class='glyphicon glyphicon-exclamation-user'> Ver recetas</span></a>"+
            
            "</div>"+
            "</div>"+
            "</div>"+
            "</div>");
        }
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function inicio()
{
    mostrarTodosLosSeguidos();
}