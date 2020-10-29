$(document).ready(function()
{
    $("#agregarPaso").click(function(event) {
        
        $("#listPasos").append($("<div>").load('../php/pasos%20dinamicos.php'));
       });
    $("#agregarTipo").click(function(event) {
     
     $("#listTipos").append($("<div>").load('../php/tipos%20dinamicos.php'));
    });
    $("#agregarIngrediente").click(function(event) {
        
        $("#listIngredientes").append($("<div>").load('../php/ingredientes%20dinamicos.php'));
    });
})