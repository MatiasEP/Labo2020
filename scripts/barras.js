$(document).ready(inicio)

function cambiarRutaAction(value)
{
    if(value == 1)
    {
        $("#buscador").attr("action","./mostrar recetas por titulo.php");
    }
    else if(value == 2)
    {
        $("#buscador").attr("action","./mostrar recetas por ingredientes.php");
    }
}

function inicio()
{
    let select = $("#selectBuscador")
    var actual;
    $(select).on('change', (event)=>
    {
        actual = event.target.value;
        cambiarRutaAction(actual);
    });
}