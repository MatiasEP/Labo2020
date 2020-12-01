$(document).ready(function()
{
    estadoSesion();

})



    function estadoSesion() {
        $.get("http://localhost/Labo2020/index.php?accion=isLoggedIn", function(data, status){
            var primero = $("#primero");
            var segundo = $("#segundo");
            var tercero = $("#tercero");
            var cuarto = $("#cuarto");
            var quinto = $("#quinto");
            var sexto = $("#sexto");

            if(data==true){

                segundo.text ("Crear Receta");
                segundo.attr("href", "agregar%20receta.php");
                
                tercero.text ("Mis Recetas");
                tercero.attr("href", "mostrar%20recetas%20por%20usuario.php");
                
                cuarto.text ("Mis Favoritos");
                cuarto.attr("href", "mostrar%20recetas%20favoritas.php");

                quinto.text ("Usuarios seguidos");
                quinto.attr("href", "mostrar%20usuarios%20seguidos.php");
                
                sexto.text ("cerrar sesion");
                sexto.attr("href", "#");
                sexto.click(cerrarSesion);
                datosUsuario();
            }else{
                primero.text ( "iniciar sesion");
                $.get("http://localhost/Labo2020/index.php?login", function(data, status){
                    primero.attr("href", data);
                    segundo.text ("");
                    segundo.attr("href", "#");
                    tercero.text ("");
                    tercero.attr("href", "#");
                    cuarto.text ("");
                    cuarto.attr("href", "#");
                    quinto.text ("");
                    quinto.attr("href", "#");
                    sexto.text ("");
                    sexto.attr("href", "#");
                    
               });  
            }
       });   
    }
  
 
    function cerrarSesion() {
        $.get("http://localhost/Labo2020/index.php?accion=logout", function(data, status){
            estadoSesion();
            location.reload();

       });   
       
    }

    function datosUsuario() {
        $.get("http://localhost/Labo2020/index.php?accion=usuarioGoogle", function(data, status){
            var micuenta = $("#primero");
            micuenta.text (data.email);
       });   
    }