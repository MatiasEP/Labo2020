
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");

    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();

    echo $ctrl->reportes();
?>