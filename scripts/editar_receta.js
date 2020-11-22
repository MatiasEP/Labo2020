$(document).ready(inicio)
var categorias;

function cargarJsonCategorias()
{
    let request = $.ajax(
    {
    method: "POST",
    url: "../json/categorias.json"
    });
    request.done(function(data) 
    {           
        categorias = data;
    })  /*
    .fail(function() {
    alert("Algo salió mal");
    });  
    request.always(function() {
    alert("Siempre se ejecuta")
    });*/
}

function cargarUltimoTipo()
{
    $('#listTipos').children("div").children("#tipo").last().append('<option value="null" selected disabled>'+ "Seleccionar categoria" + '</option>');
        for(let j = 0; j<categorias.length; j++)
        {
            let cat = categorias[j]["nombre"];
            $('#listTipos').children("div").children("#tipo").last().append('<option value="'+cat+'">'+cat+'</option>');
        }
}

function imprimirCategorias(categoriasReceta)
{
    for(let i = 0; i< categoriasReceta.length; i++)
    {     
        let request = $.ajax(
        {
            method: "POST",
            url: "../php/tipos%20dinamicos.php"
        });
            request.done(function(data) 
            {           
                $("#listTipos").append($("<div>").append(data));                        
                cargarUltimoTipo();
                console.log(categoriasReceta[i])
                $('#listTipos').children("div").children("#tipo").last().val(categoriasReceta[i]).change();
            })
        
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
            let titulo = data[i]["titulo"];
            $("#titulo").val(titulo);
            let imgPrincipal = data[i]["imagen"];
            $("#imgPrincipalPreview").attr("src",imgPrincipal);
            imprimirCategorias(categorias);
            imprimirIngredientes(ingredientes);
            imprimirPasos(pasos);
        }
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}


function inicio()
{
    $('#imgPrincipal').change(function(e) {
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function(){      
        $("#imgPrincipalPreview").attr("src",reader.result);}
    });
    //visualizarReceta();
    cargarJsonCategorias();
    visualizarReceta();
}