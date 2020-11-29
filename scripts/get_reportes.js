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

function visualizarReportes()
{
    let request = $.ajax(
    {
        method: "POST",
        url: "../php/get_reportes.php"
    });
        request.done(function(data) {  
            $("#main").empty();
            $("#main").append(  "<h1>Reportes:<h1><br><br>");            
            for(let i = 0; i<data.length;i++)
            {
                $("#main").append("<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>"+
                "<div class='panel panel-primary' >"+   
                "<div class='panel-heading'>"+data[i]["receta"][0]["titulo"]+"</div>"+
                "<div class='panel-body' >"+       
                "<img src="+data[i]["receta"][0]["imagen"]+" class='thumbnail' alt='preview'>"+
                "<div class='panel-footer verReporte' ><a href='#' class='btn btn-danger' data-toggle='modal' data-target='#myModal' id='receta"+i+"'>"+
                "<span class='glyphicon glyphicon-exclamation-sign '> Ver reporte</span></a>"+
                
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>");
                
                $("#receta"+i).click(function()
                {
                    $("#verReceta").attr("href","../paginas/visualizar_receta.php?id="+(Object.values(data[i]["idReceta"]))[0])
                    $("#motivo").val(data[i]["texto"])
                    $("#ignorarReceta").click(function()
                    {
                        let parametros={
                            "reporte":data[i]["_id"],
                        }
                        let request = $.ajax(
                            {
                                method: "POST",
                                url: "../php/ignorar_reporte.php",
                                data:parametros
                            });
                        request.done(function(data){
                            visualizarReportes();
                        })
                    })
                })
            }
        
        })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function inicio()
{
    visualizarReportes();
}