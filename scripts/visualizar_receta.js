$(document).ready(inicio)
var data2;

function imprimirCategorias(categorias)
{
    for(let i = 0; i< categorias.length; i++)
    {        
        $("#categorias").append(categorias[i]+"<br>");
    }
}

function imprimirIngredientes(ingredientes)
{
    for(let i = 0; i< ingredientes.length; i++)
    {        
        $("#ingredientes").append("Descripcion: "+ingredientes[i]["descripcion"]+"   Cantidad: "+ingredientes[i]["cantidad"]);
    }
}

function imprimirPasos(pasos)
{
    for(let i = 0; i< pasos.length; i++)
    {        
        $("#pasos").append("Paso "+(i+1)+": "+pasos[i]["descripcion"]+"<br>"+"<img src='"+pasos[i]["imagen"]+"'>");
    }
}

function visualizarReceta()
{
    let request = $.ajax(
    {
        method: "POST",
        url: "../json/visualizar_receta.json"
    });
        request.done(function(data) {  
        for(let i = 0; i<data.length;i++)
        {            
            let categorias = data[i]["tipo"];
            let ingredientes = data[i]["ingredientes"];
            let pasos = data[i]["pasos"];
            $("#titulo").text(data[i]["titulo"]);
            $("#imgPrincipal").attr("src",data[i]["imagen"]);
            imprimirCategorias(categorias);
            imprimirIngredientes(ingredientes);
            imprimirPasos(pasos);
        }
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function agregarAFavoritos()
{
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
       /*let parametros = {
        "idUsuario" : $idUsuario,
        "idReceta" : $idReceta
    };*/
    let request = $.ajax(
    {
        //data: parametros,
        method: "POST",
        url: "../php/agregar_a_favoritos.php"
    });
        request.done(function(data) {  
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function eliminarDeFavoritos()
{
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
       /*let parametros = {
        "idUsuario" : $idUsuario,
        "idReceta" : $idReceta
    };*/
    let request = $.ajax(
    {
        //data: parametros,
        method: "POST",
        url: "../php/eliminar_de_favoritos.php"
    });
        request.done(function(data) {  
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function crearJsonComprobarFavorito()
{
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
       /*let parametros = {
        "idUsuario" : $idUsuario,
        "idReceta" : $idReceta
    };*/
    let request = $.ajax(
        {
            //data: parametros,
            method: "POST",
            url: "../php/comprobar_favorito.php"
        });
            request.done(function(data) {  
            
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function cargarJsonComprobarFavorito()
{
    let request = $.ajax(
        {
            method: "GET",
            url: "../json/comprobar_favorito.json"
        });
            request.done(function(data) {  
            if(data.length == 0)
            {
                $("#favorito").text("Agregar a favoritos");
                $("#favorito").on("click",function()
                {                    
                    agregarAFavoritos();
                })
            }
            else
            {
                $("#favorito").text("Eliminar de favoritos");                
                $("#favorito").on("click",function()
                {                    
                    eliminarDeFavoritos();
                })
            }
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function inicio()
{
    visualizarReceta();
    crearJsonComprobarFavorito();
    setTimeout(cargarJsonComprobarFavorito,500);
    $("#favorito").on("click",function()
    {    
        cargarJsonComprobarFavorito();
        setTimeout(crearJsonComprobarFavorito,200);
        setTimeout(cargarJsonComprobarFavorito,1200);
    })
}