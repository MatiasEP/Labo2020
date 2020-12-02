
<?php

    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");

    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();

    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $idUsuario =  $ctrl->getUserInfo()->_id->__toString();
    
    if($idUsuario !='' && $idReceta !='')
    {        
        echo $ctrl->eliminar_favorito($idUsuario, $idReceta);
    }
    else
    {
        echo ("ingrese una receta valida");
    }
    
         
        
   
?>