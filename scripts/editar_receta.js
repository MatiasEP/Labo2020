$(document).ready(inicio)
var categorias;
var seleccionArchivos;
var seleccionpreview;

function cargarJsonCategorias()
{
    let request = $.ajax(
    {
    method: "POST",
    url: "../php/get_categorias.php"
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
                $('#listTipos').children("div").children("#tipo").last().val(categoriasReceta[i]).change();
            })
        
    }
}

function imprimirIngredientes(ingredientes)
{
    for(let i = 0; i< ingredientes.length; i++)
    {     
        let request = $.ajax(
        {
            method: "POST",
            url: "../php/ingredientes%20dinamicos.php"
        });
            request.done(function(data) 
            {           
                $("#listIngredientes").append($("<div>").append(data));   
                $('#listIngredientes').children("div").children("#ingrediente").last().val(ingredientes[i]["descripcion"]);
                $('#listIngredientes').children("div").children("#cantidad").last().val(ingredientes[i]["cantidad"]);
            })
        
    }
}

function imprimirPasos(pasos)
{
    for(let i = 0; i< pasos.length; i++)
    {     
        let request = $.ajax(
        {
            method: "POST",
            url: "../php/pasos%20dinamicos.php"
        });
            request.done(function(data) 
            {           
                $("#listPasos").append($("<div id='paso"+i+"'>").append(data));
                $('#listPasos').children("div").children("#paso").last().val(pasos[i]["descripcion"]);
                $('#listPasos').children("div").children("#imgPasoPreview").last().attr("src",pasos[i]["imagen"]).attr("id","imgPasoPreview"+i); 
                $('#listPasos').children("div").children("#labelPaso").children("#hPaso").last().html("Paso "+(i+1)+" :");               
                $("#imgPasoPreview"+i).removeClass("oculto");
                $('#listPasos').children("div").children("#imagen").last().attr("id","imagen"+i);        
                $('#listPasos').children("div").children("label").last().attr("for","imagen"+i);
                
                seleccionArchivos = document.querySelectorAll("#listPasos");
                $("#listPasos").children("#paso"+i+"").children("#imagen"+i+"").change(function(e)
                {
                    var reader = new FileReader();
                    reader.readAsDataURL(e.target.files[0]);
                    reader.onload = function()
                    {      console.log(i)
                        $(seleccionArchivos).children("#paso"+i+"").children("#imgPasoPreview"+i+"").attr("src",reader.result);
                        $(seleccionArchivos).children("#paso"+i+"").children("#imgPasoPreview"+i+"").removeClass("oculto")
                    }        
                })
                /*
                $('#listPasos').children("div").children("#imagen").last().change(function(e)  {
                    
                    let reader = new FileReader();
                    let actual = $(this);
                    
                        
                    reader.readAsDataURL(e.target.files[0]);
                    
                    
                    reader.onload = function(){      
                    actual.siblings("#imgPasoPreview").attr("src",reader.result);}})*/
                    seleccionpreview = document.querySelectorAll("#imgPasoPreview");
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
        setTimeout(console.log("tiempo"),300);
    }
}

function visualizarReceta()
{
    let params = new URLSearchParams(location.search);
    var idUrl = params.get('id');
    let request = $.ajax(
    {
        method: "GET",
        url: "../php/visualizar_receta.php",
        data: { 
            id: idUrl
          }
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


function pasosConImagenes()
{
    setTimeout(function()
    {
        var pasos = $(seleccionArchivos).children();
        for(var i=0;i<pasos.length;i++)
        {   const actual = i;//por alguna razon, no tomaba bien el indice directamente    
            previews(actual)
        } 
    },1500);
}
function agregarPaso()
{ 
    console.log("wea");  
        let request = $.ajax(
        {
            method: "POST",
            url: "../php/pasos%20dinamicos.php"
        });
            request.done(function(data) 
            {         
                
                seleccionArchivos = document.querySelectorAll("#listPasos");
                let i = $(seleccionArchivos).children().length;
                $("#listPasos").append($("<div id='paso"+(i)+"'>").append(data));
                $('#listPasos').children("div").children("#imgPasoPreview").last().attr("id","imgPasoPreview"+(i));
                $('#listPasos').children("div").children("#labelPaso").children("#hPaso").last().html("Paso "+(i+1)+" :");       
                $('#listPasos').children("div").children("#imagen").last().attr("id","imagen"+(i));        
                $('#listPasos').children("div").children("label").last().attr("for","imagen"+(i)).text("Seleccionar imagen");
                
            })
}

function eventAgregarPaso()
{    
    agregarPaso();
    pasosConImagenes();
}

function inicio()
{
    $('#imgPrincipal').change(function(e) {
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function(){      
        $("#imgPrincipalPreview").attr("src",reader.result);}
    });/*
    $("#pasimg").each(function()
    {
        let reader
        $(this).children("#imagen").change(function(e)
        {
            reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
        })
        
        reader.onload = function(){ 
            $(this).children("#imgPasoPreview").attr("src",reader.result);}
    })*/
    //visualizarReceta();
    cargarJsonCategorias();
    visualizarReceta();
    
    //seleccionArchivos = document.querySelectorAll("#imagen");
  
  // Escuchar cuando cambie
  /*$(seleccionArchivos).on("click",function()  {
      console.log("pepe")/*
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

    /*$('#imagen').on("change",function(e) {
        console.log("pepe")
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        console.log(reader.result)
        reader.onload = function(){      
        $("#imgPasoPreview").attr("src",reader.result);}
    });*/
    
    /*setTimeout(function()
    {
        $(seleccionArchivos).each(function(i)  
        {
            $(this).change(function(e)
            {
                let reader = new FileReader();
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = function(){
                    $(seleccionpreview[i]).attr("src",reader.result);
                }
            })
        })
    },500);*//*
    setTimeout(function()
    {
        for(var i=0;i<seleccionArchivos.length;i++)
        {
            var actual = i;
            seleccionArchivos[i].addEventListener("change",function(e){
                let reader = new FileReader();
                console.log(actual +" "+i);
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = function()
                {      
                    $(seleccionpreview[actual]).attr("src",reader.result);
                }
            },false)
        }
    },500)*/
    //pasosConImagenes();
    /*
    $(seleccionArchivos).children("#paso0").children("#imagen0").change(function(e){
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function()
        {      
            $(seleccionArchivos).children("#paso0").children("#imgPasoPreview0").attr("src",reader.result);
        }
    })
    $(seleccionArchivos).children("#paso1").children("#imagen1").change(function(e){
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function()
        {      
            $(seleccionArchivos).children("#paso1").children("#imgPasoPreview1").attr("src",reader.result);
        }
    })
    $(seleccionArchivos).children("#paso2").children("#imagen2").change(function(e){
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = function()
        {      
            $(seleccionArchivos).children("#paso2").children("#imgPasoPreview2").attr("src",reader.result);
        }
    })
    }*/

    $("#agregarPaso").unbind("click").bind("click",function(e) {
        eventAgregarPaso();
       });
    $("#agregarTipo").unbind("click").bind("click",function() {
     
     $("#listTipos").append($("<div>").load('../php/tipos%20dinamicos.php'));
     cargarCategoriasConDelay();
    });
    $("#agregarIngrediente").unbind("click").bind("click",function() {
        
        $("#listIngredientes").append($("<div>").load('../php/ingredientes%20dinamicos.php'));
    });
}