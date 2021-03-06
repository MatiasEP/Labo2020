$(document).ready(function()
{
    cargarCategoriasEnUltimoSelect();
    eventImgPrincipalPreview();
    enviarReceta();
    seleccionArchivos = document.querySelectorAll("#listPasos");
    seleccionpreview = document.querySelectorAll("#imgPasoPreview");
    pasosConImagenes();
    $("#agregarPaso").click(function(event) {
        
        agregarPaso();
        pasosConImagenes();
       });
    $("#agregarTipo").click(function(event) {
     
     $("#listTipos").append($("<div>").load('../php/tipos%20dinamicos.php'));
     cargarCategoriasConDelay();
    });
    $("#agregarIngrediente").click(function(event) {
        
        $("#listIngredientes").append($("<div>").load('../php/ingredientes%20dinamicos.php'));
    });
});

var seleccionArchivos;
var seleccionpreview;

function agregarPaso()
{ 
        let request = $.ajax(
        {
            method: "POST",
            url: "../php/pasos%20dinamicos.php"
        });
            request.done(function(data) 
            {           
                
                seleccionArchivos = document.querySelectorAll("#listPasos");
                seleccionpreview = document.querySelectorAll("#imgPasoPreview");
                let i = $(seleccionArchivos).children().length;
                $("#listPasos").append($("<div id='paso"+(i)+"'>").append(data));
                $('#listPasos').children("div").children("#imgPasoPreview").last().attr("id","imgPasoPreview"+(i));
                $('#listPasos').children("div").children("#labelPaso").children("#hPaso").last().html("Paso "+(i+1)+" :");
                $('#listPasos').children("div").children("#imagen").last().attr("id","imagen"+(i));        
                $('#listPasos').children("div").children("label").last().attr("for","imagen"+(i)).text("Seleccionar imagen");
                
                /*
                $('#listPasos').children("div").children("#imagen").last().change(function(e)  {
                    
                    let reader = new FileReader();
                    let actual = $(this);
                    
                        
                    reader.readAsDataURL(e.target.files[0]);
                    
                    
                    reader.onload = function(){      
                    actual.siblings("#imgPasoPreview").attr("src",reader.result);}})*/
                    /*
                      // Los archivos seleccionados, pueden ser muchos o uno
                      const archivos = $seleccionArchivos.files;
                      // Si no hay archivos salimos de la función y quitamos la imagen
                      if (!archivos || !archivos.length) {
                        $imagenPrevisualizacion.src = "";
                        return;
                      }
                      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                      const primerArchivo = archivos[0];
                      // Lo convertimos a un objeto de tipo objectURL
                      const objectURL = URL.createObjectURL(primerArchivo);
                      // Y a la fuente de la imagen le ponemos el objectURL
                    $imagenPrevisualizacion.src = objectURL;})*/
            })
}

function enviarReceta()
{

    
    $('#form').submit(function(e) {
        e.preventDefault();

        //var formData = new FormData(this);//a revisar, no pasa bien los datos, o tiene conflicto con los datos del back
        var indice=0;
        var postdata = {
            carga: true,
            titulo: $("#titulo").val(),
            imgPrincipal : $("#imgPrincipalPreview").attr("src"),
            tipos:$("[name='tipo[]']").map(function(){return this.value;}).get(),
            ingredientes:$("[name='ingrediente[]']").map(function(){return this.value;}).get(),
            cantidad:$("[name='cantidad[]']").map(function(){return this.value;}).get(),
            paso:$("[name='paso[]']").map(function(){return this.value;}).get(),
            imgPaso:$("[name='paso[]']").map(function(){return $("#imgPasoPreview"+indice).attr("src")==undefined?"nodata":$("#imgPasoPreview"+indice++).attr("src");}).get()
            
        }

        $.ajax({
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", // $_POST
            dataType : "json",
            method: "POST",
            url: "../php/agregar receta.php",
            data: {receta: postdata},
        success: function(data) {
            if(data)
            {
                $("#myModal").modal("show");
            }
            else
            {
                $("#myModal2").modal("show");
            }
            
        }
        })
    })
}



function cargarCategoriasEnUltimoSelect()
{
    let request = $.ajax(
    {
    method: "POST",
    url: "../php/get_categorias.php"
    });
    request.done(function(data) 
    {           
        $('#listTipos').children("div").children("#tipo").last().append('<option value="" selected disabled>'+ "Seleccionar categoria" + '</option>');
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

function previews(indice)
{
    $(seleccionArchivos).children("#paso"+indice+"").children("#imagen"+indice+"").change(function(e)
        {
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = function()
            {      console.log(indice)
                $(seleccionArchivos).children("#paso"+indice+"").children("#imgPasoPreview"+indice+"").attr("src",reader.result);
                $(seleccionArchivos).children("#paso"+indice+"").children("#imgPasoPreview"+indice+"").removeClass("oculto")
            }        
        })
}

function eventImgPrincipalPreview()
{
    $("#imgPrincipal").change(function(e)
        {
            var reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = function()
            { 
                $("#imgPrincipalPreview").attr("src",reader.result);
                $("#imgPrincipalPreview").removeClass("oculto");
            }        
        })
}

function pasosConImagenes()
{
    setTimeout(function()
    {
        var pasos = $(seleccionArchivos).children();
        for(var i=0;i<pasos.length;i++)
        {   const actual = i;//por alguna razon, no tomaba bien el indice directamente    
            previews(actual)
        } 
    },1000);
}

function cargarCategoriasConDelay()
{      
    setTimeout(cargarCategoriasEnUltimoSelect,100); 
}