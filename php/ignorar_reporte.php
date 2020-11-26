
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    $id = isset($_POST["reporte"])?$_POST["reporte"]:'';
    if($id != '')
        {        
        $googleClient = new Google_Client();
        $auth = new GoogleAuth($googleClient);  
        $ctrl = new Operaciones();

        echo $ctrl->borrar_reporte($id);
    }
?>