$(document).ready(inicio)

function cambiarRutaAction(value)
{
    if(value == 1)
    {
        $("#buscador").attr("action","./mostrar recetas por titulo.php");
        $("#divCategoria").addClass("d-none")
        $("#divBusqueda").removeClass("d-none");
    }
    else if(value == 2)
    {
        $("#buscador").attr("action","./mostrar recetas por ingredientes.php");
        $("#divCategoria").addClass("d-none")
        $("#divBusqueda").removeClass("d-none");
    }
    else if(value == 3)
    {
        $("#buscador").attr("action","./mostrar recetas por tipo.php");
        $("#divBusqueda").addClass("d-none");
        $("#divCategoria").removeClass("d-none")
    }
}

function cargarCategorias()
{
    let request = $.ajax(
        {
            method: "POST",
            url: "../php/get_categorias.php"
        });
            request.done(function(data) { 
            $('#categoriaS2').append('<option value="null" selected disabled>'+ "Seleccionar categoria" + '</option>');
            for(let j = 0; j<data.length ; j++)
            {
                let categoria = data[j]["nombre"];
                $('#categoriaS2').append('<option value="'+categoria+'">'+categoria+'</option>');
            }
        });
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function inicio()
{
    $("#categoriaS2").select2();
    cargarCategorias();
    let select = $("#selectBuscador")
    var actual;
    $(select).on('change', (event)=>
    {
        actual = event.target.value;
        cambiarRutaAction(actual);
    });
}