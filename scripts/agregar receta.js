$(document).ready(function()
{
    cargarCategoriasEnUltimoSelect();
    $("#agregarPaso").click(function(event) {
        
        $("#listPasos").append($("<div>").load('../php/pasos%20dinamicos.php'));
       });
    $("#agregarTipo").click(function(event) {
     
     $("#listTipos").append($("<div>").load('../php/tipos%20dinamicos.php'));
     cargarCategoriasConDelay();
    });
    $("#agregarIngrediente").click(function(event) {
        
        $("#listIngredientes").append($("<div>").load('../php/ingredientes%20dinamicos.php'));
    });
});

function cargarCategoriasEnUltimoSelect()
{
    let request = $.ajax(
    {
    method: "POST",
    url: "../json/categorias.json"
    });
    request.done(function(data) 
    {           
        $('#listTipos').children("div").children("#tipo").last().append('<option value="null" selected disabled>'+ "Seleccionar categoria" + '</option>');
        for(let i = 0; i<data.length; i++)
        {
            let categoria = data[i]["nombre"];
            $('#listTipos').children("div").children("#tipo").last().append('<option value="'+categoria+'">'+categoria+'</option>');
        }
    })  /*
    .fail(function() {
    alert("Algo salió mal");
    });  
    request.always(function() {
    alert("Siempre se ejecuta")
    });*/
}

function cargarCategoriasConDelay()
{      
    setTimeout(cargarCategoriasEnUltimoSelect,100); 
}