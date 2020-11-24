<?php
    require_once("vendor/autoload.php");
    require_once("app/clases/google_auth.php");
    require_once("app/clases/operaciones.php");
    require_once("app/init.php");

    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();
    if($auth->checkRedirectCode()){
        //die($_GET['code']);
        header('Location: http://localhost/Labo2020/paginas/mostrartodaslasrecetas.php');
    }
    if(isset($_GET["accion"])){
        echo $ctrl->accion($_GET["accion"]);
    }else{
        if(isset($_GET["login"])){
            echo $auth->getAuthUrl();
        }else{
            echo "<br>";
           if($ctrl->isLoggedIn()){
            header('Location: http://localhost/Labo2020/paginas/mostrartodaslasrecetas.php');

            echo "usar servicios<br>";
            echo "<a href='http://localhost/Labo2020/index.php?login'>http://localhost/Labo2020/index.php?login</a><br>";
            echo "<a href='http://localhost/Labo2020/index.php?accion=logout'>http://localhost/Labo2020/index.php?accion=logout</a><br>";
            echo "<a href='http://localhost/Labo2020/index.php?accion=roles'>http://localhost/Labo2020/index.php?accion=roles</a><br>";
            echo "<a href='http://localhost/Labo2020/index.php?accion=email'>http://localhost/Labo2020/index.php?accion=email</a><br>";
            echo "<a href='http://localhost/Labo2020/index.php?accion=usuario'>http://localhost/Labo2020/index.php?accion=usuario</a><br>";
            echo "<a href='http://localhost/Labo2020/index.php?accion=usuarioGoogle'>http://localhost/Labo2020/index.php?accion=usuarioGoogle</a><br>";
            echo "<a href='http://localhost/Labo2020/index.php?accion=isLoggedIn'>http://localhost/Labo2020/index.php?accion=isLoggedIn</a><br>";
           }
           else{
               echo "usar servicios <br> <a href='http://localhost/Labo2020/index.php?login'> http://localhost/Labo2020/index.php?login</a><br>";
               header('Location: http://localhost/Labo2020/paginas/mostrartodaslasrecetas.php');

            }
        }
    }

?>