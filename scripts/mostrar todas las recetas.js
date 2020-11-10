$(document).ready(inicio)

function tipos(aTipos)
{
    let array = [];
    {for(let j=0; j<aTipos.length;j++)
    {
        array.push(" "+aTipos[j]+" ");
    }}
    return array;
}

function mostrarTodasLasRecetas()
{
    let request = $.ajax(
    {
        method: "POST",
        url: "../json/mostrar todas las recetas.json"
    });
        $("#main").empty();
        request.done(function(data) {  
        $("#main").append(  "<h1>Inicio<h1><br><br>");       
        for(let i = 0; i<data.length;i++)
        {
            $("#main").append("<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>"+
            "<div class='panel panel-primary' >"+   
            "<div class='panel-heading'>"+data[i]["titulo"]+"</div>"+
            "<div class='panel-body' >"+       
            "<a href='../paginas/visualizar_receta.php?id="+(Object.values(data[i]["_id"]))[0]+"'><img src="+data[i]["imagen"]+" class='thumbnail' alt='preview'></a>"+
            "<div class='panel-footer' >Categoria: "+tipos(data[i]["tipo"])+
            
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
    mostrarTodasLasRecetas();
}