$(document).ready(inicio)
var data2;
var idCreador;
var nombreCreador;
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
        $("#pasos").append("Paso "+(i+1)+": "+pasos[i]["descripcion"]+"<br>"+"<img src='"+(pasos[i]["imagen"]).replace(/ /g, '%20')+"'>");
    }
}



function getCreador(idCreador)
{
    let request = $.ajax(
        {
            method: "POST",
            url: "../php/get_creador.php",
            data: { 
                id: idCreador,
              }
        });
        request.done(function(data) 
        {
            $("#imgCreador").attr("src",data[0]["picture"]);
            $("#zeldaCreador").attr("href","../paginas/mostrar%20recetas%20por%20usuario.php?id="+Object.values(data[0]["_id"]));
            nombreCreador = data[0]["nombre"];
        })
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
            id: idUrl,
          }
    });
        request.done(function(data) {              
        idCreador = Object.values(data[0]["_idCreador"])[0];            
        getCreador(idCreador);
        for(let i = 0; i<data.length;i++)
        {            
            let categorias = data[i]["tipo"];
            let ingredientes = data[i]["ingredientes"];
            let pasos = data[i]["pasos"];
            $("#titulo").text(data[i]["titulo"]);
            $("#imgPrincipal").attr("src",(data[i]["imagen"]).replace(/ /g, '%20'));
            imprimirCategorias(categorias);
            imprimirIngredientes(ingredientes);
            imprimirPasos(pasos);
        }        
        comprobarSeguido();
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function agregarAFavoritos()
{
    let params = new URLSearchParams(location.search);
    let idReceta = params.get('id');
    let parametros = {
    "idReceta" : idReceta
    };
    let request = $.ajax(
    {
        data: parametros,
        method: "POST",
        url: "../php/agregar_a_favoritos.php"
    });
        request.done(function(data) {  
            comprobarFavorito();
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function eliminarDeFavoritos()
{
    let params = new URLSearchParams(location.search);
    let idReceta = params.get('id');
    let parametros = {
    "idReceta" : idReceta
    };
    let request = $.ajax(
    {
        data: parametros,
        method: "POST",
        url: "../php/eliminar_de_favoritos.php"
    });
        request.done(function(data) {  
            comprobarFavorito();
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}


function comprobarFavorito()
{
    //el id de usuario se tomara de la sesion, eso lo deberia modificar ale
    //id de receta se tomara de la receta actual
    let params = new URLSearchParams(location.search);
    let idReceta = params.get('id');
    let parametros = {
    "idReceta" : idReceta
    };
    let request = $.ajax(
        {
            data: parametros,
            method: "POST",
            url: "../php/comprobar_favorito.php"
        });
            request.done(function(data) { 
                console.log(data) 
            if(data.length == 0)
            {
                $("#favorito").text("Agregar a favoritos");
                $("#favorito").addClass("agregar");
                $("#favorito").removeClass("eliminar");
            }
            else
            {
                $("#favorito").text("Eliminar de favoritos");        
                $("#favorito").addClass("eliminar");
                $("#favorito").removeClass("agregar");
            }
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function comprobarSeguido()
{
    let parametros = {
    "idCreador" : idCreador
    };
    let request = $.ajax(
        {
            data: parametros,
            method: "POST",
            url: "../php/comprobar_seguido.php"
        });
            request.done(function(data) { 
                console.log(data) 
            if(data.length == 0)
            {
                $("#seguirCreador").text("Seguir a "+nombreCreador);
                $("#seguirCreador").addClass("glyphicon-eye-open")
                $("#seguirCreador").removeClass("glyphicon-eye-close")
                $("#btnCreador").addClass("agregar");
                $("#btnCreador").removeClass("eliminar");
            }
            else
            {
                $("#seguirCreador").text("Dejar de seguir a "+nombreCreador);
                $("#seguirCreador").addClass("glyphicon-eye-close")        
                $("#seguirCreador").removeClass("glyphicon-eye-open")
                $("#btnCreador").addClass("eliminar");
                $("#btnCreador").removeClass("agregar");
            }
        })
        request.fail(function() {
        alert("Algo salió mal");
        });
}

function dejarDeSeguir()
{
    let parametros = {
    "idCreador" : idCreador
    };
    let request = $.ajax(
    {
        data: parametros,
        method: "POST",
        url: "../php/dejar_de_seguir.php"
    });
        request.done(function(data) {  
            comprobarSeguido();
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function seguir()
{
    let parametros = {
    "idCreador" : idCreador
    };
    let request = $.ajax(
    {
        data: parametros,
        method: "POST",
        url: "../php/seguir_usuario.php"
    });
        request.done(function(data) {  
            comprobarSeguido();
        
    })
    request.fail(function() {
    alert("Algo salió mal");
    });
}

function descargarPDF()
{
	// Replace this with your PDFmyURL license - you get one when you sign up at https://pdfmyurl.com/plans
	var license = 'OWC4qMhCRThX';
		// The following code is now linked to the PDF button

		// now we replace the stylesheets with their absolute URL version
		var elements = document.querySelectorAll('link[rel=stylesheet]');
		for(var i=0;i<elements.length;i++){
			var head = document.head;
	    	var link = document.createElement("link");
	    	link.type = "text/css";
	    	link.rel = "stylesheet";
	    	link.href = elements[i].href;
	    	head.appendChild(link);
	    	
			elements[i].parentNode.removeChild(elements[i]);
		}

		// let's convert all images to data so they don't need to be downloadable  	
		function setBase64Image(img) {
			var canvas = document.createElement("canvas");
			canvas.width = img.width;
			canvas.height = img.height;
			var ctx = canvas.getContext("2d");
			ctx.drawImage(img, 0, 0);
			var dataURL = canvas.toDataURL("image/png");
			img.src = dataURL;
				
		}

		var images = document.getElementsByTagName("img");
		if (images.length > 0) {
			for (var j=0; j<images.length; j++ ) {
				setBase64Image(images[j]);
			}
		}

		// now we'll take ALL HTML including the doctype
		var html = '', node = document.firstChild;
		while (node) {
			switch (node.nodeType) {
				case Node.ELEMENT_NODE:
					html += node.outerHTML;
					break;
				case Node.TEXT_NODE:
					html += node.nodeValue;
					break;
				case Node.CDATA_SECTION_NODE:
					html += '<![CDATA[' + node.nodeValue + ']]>';
					break;
				case Node.COMMENT_NODE:
					html += '<!--' + node.nodeValue + '-->';
					break;
				case Node.DOCUMENT_TYPE_NODE:
					// (X)HTML documents are identified by public identifiers
					html += "<!DOCTYPE " + node.name + (node.publicId ? ' PUBLIC "' + node.publicId + '"' : '') + (!node.publicId && node.systemId ? ' SYSTEM' : '') + (node.systemId ? ' "' + node.systemId + '"' : '') + '>\n';
					break;
			}
			node = node.nextSibling;
		}	    	

		var data = { html: html, license: license };
		// You can pass all the parameters you like if you want, but you don't need to if your defaults in our members area are already good

		// we will show an in progress message with a BootStrap modal
		$('#inProgress').modal('show');
			
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			var a;
			if (xhttp.readyState === 4 && xhttp.status === 200) {
				// the PDF is ready so we remove the in progress message
				$('#inProgress').modal('hide');

				// and show the PDF
				var filename = "receta.pdf";
				if (window.navigator && window.navigator.msSaveOrOpenBlob) { 
					window.navigator.msSaveOrOpenBlob(xhttp.response, filename);
				} else { 
					a = document.createElement('a');
					a.href = window.URL.createObjectURL(xhttp.response);
					a.download = filename;
					a.style.display = 'none';
					document.body.appendChild(a);
					a.click();
				}
			}
		};
		
		xhttp.open("POST", "https://pdfmyurl.com/api", true);
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhttp.responseType = 'blob';
		xhttp.send($.param( data ));
}

function inicio()
{
    visualizarReceta();
    comprobarFavorito();
    $("#favorito").on("click",function()
    {    
        if($("#favorito").hasClass("agregar"))
        {
            agregarAFavoritos();
        }
        else if($("#favorito").hasClass("eliminar"))
        {
            eliminarDeFavoritos();
        }
    })
    $("#btnCreador").on("click",function()
    {    
        if($("#btnCreador").hasClass("agregar"))
        {
            seguir();
        }
        else if($("#btnCreador").hasClass("eliminar"))
        {
            dejarDeSeguir();
        }
    })
    $("#descargar").on("click",descargarPDF);
}