
<?php

    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");

    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();

    $idCreador= isset($_POST["idCreador"])?$_POST["idCreador"]:'';
    $idUsuario =  $ctrl->getUserInfo()->_id->__toString();
    
    if($idUsuario !='' && $idCreador !='')
    {        
        echo $ctrl->comprobar_seguido($idUsuario, $idCreador);
    }
    else
    {
        echo ("ingrese un creador valido");
    }
?>