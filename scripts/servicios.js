$(document).ready(function()
{
    estadoSesion();

})



    function estadoSesion() {
        $.get("http://localhost/Labo2020/index.php?accion=isLoggedIn", function(data, status){
            var sesionData = $("#sesionData");
            var micuenta = $("#micuenta");
            if(data==true){
                sesionData.text ("cerrar sesion");
                sesionData.attr("href", "#");
                sesionData.click(cerrarSesion);
                datosUsuario();
            }else{
                sesionData.text ( "iniciar sesion");
                $.get("http://localhost/Labo2020/index.php?login", function(data, status){
                    sesionData.attr("href", data);
                    micuenta.text ("");
                    micuenta.attr("href", "#");
               });  
            }
       });   
    }
  
 
    function cerrarSesion() {
        $.get("http://localhost/Labo2020/index.php?accion=logout", function(data, status){
            estadoSesion();
       });   
    }

    function datosUsuario() {
        $.get("http://localhost/Labo2020/index.php?accion=usuarioGoogle", function(data, status){
            var micuenta = $("#micuenta");
            micuenta.text (data.email);
       });   
    }