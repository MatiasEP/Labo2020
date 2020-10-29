$(document).ready(function()
{
    $("#agregarPaso").click(function(event) {
        
        $("#listPasos").append($("<div>").load('./pasos%20dinamicos.php'));
       });
    $("#agregarTipo").click(function(event) {
     
     $("#listTipos").append($("<div>").load('./tipos%20dinamicos.php'));
    });
    $("#agregarIngrediente").click(function(event) {
        
        $("#listIngredientes").append($("<div>").load('./ingredientes%20dinamicos.php'));
    });
})