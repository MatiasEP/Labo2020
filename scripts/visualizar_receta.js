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
    crearJsonComprobarFavorito();
    setTimeout(cargarJsonComprobarFavorito,500);
    $("#favorito").on("click",function()
    {    
        cargarJsonComprobarFavorito();
        setTimeout(crearJsonComprobarFavorito,200);
        setTimeout(cargarJsonComprobarFavorito,1200);
    })
    $("#descargar").on("click",descargarPDF);
}