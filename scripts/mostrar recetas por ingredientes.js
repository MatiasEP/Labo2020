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
        url: "../json/mostrar recetas por ingredientes.json"
    });
        $("#main").empty();
        request.done(function(data) {            
        for(let i = 0; i<data.length;i++)
        {
            $("#main").append("<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>"+
            "<div class='panel panel-primary' >"+   
            "<div class='panel-heading'>"+data[i]["titulo"]+"</div>"+
            "<div class='panel-body' >"+       
            "<img src="+data[i]["imagen"]+" class='thumbnail' alt='no tenia fotos de culo'>"+
            "<div class='panel-footer' >Tipo: "+tipos(data[i]["tipo"])+
            
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