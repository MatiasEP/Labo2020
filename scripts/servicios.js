$(document).ready(function()
{
    estadoSesion();

})



    function estadoSesion() {
        $.get("http://localhost/Labo2020/index.php?accion=isLoggedIn", function(data, status){
            var sesionData = $("#sesionData");
            var micuenta = $("#micuenta");
            var crearreceta = $("#crearreceta");
            if(data==true){
                sesionData.text ("cerrar sesion");
                sesionData.attr("href", "#");
                sesionData.click(cerrarSesion);

                crearreceta.text ("crear receta");
                crearreceta.attr("href", "agregar%20receta.php");
                
                datosUsuario();
            }else{
                sesionData.text ( "iniciar sesion");
                $.get("http://localhost/Labo2020/index.php?login", function(data, status){
                    sesionData.attr("href", data);
                    micuenta.text ("");
                    micuenta.attr("href", "#");
                    crearreceta.text ("");
                    crearreceta.attr("href", "#");
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
            var micuenta = $("#micuenta");
            micuenta.text (data.email);
       });   
    }