
<?php

    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");

    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;

    $ctrl = new Operaciones();
    if(!$ctrl->isLoggedIn()){
        echo "<script>alert('no se encuentra logueado');window.location = 'http://localhost/Labo2020/paginas/mostrar todas las recetas.php';        </script>";
    }else{

        $client = new MongoDB\Driver\Manager(sprintf(
            'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
        $idUsuario = $ctrl->getUserInfo()->_id->__toString();
        $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
        $comentario = isset($_POST["comentario"])?$_POST["comentario"]:'';
        $comentario  = htmlspecialchars($comentario, ENT_QUOTES);
       // $idReceta = "5fa58577bd0d000028004567";//temporal para test
        //$idUsuario = "5fa1f37a25700000930007ed"; //temporal para test
        
        if($idUsuario != '' and $idReceta !='' and $comentario !='')
        {        
            $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
            $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);    
            $query = new MongoDB\Driver\BulkWrite;
            $query->insert(["idReceta"=>$idReceta,"idUsuario"=>$idUsuario,"texto"=>$comentario]);
            $result = $client->executeBulkWrite("proyecto.comentarios",$query);


        }
    
    }

   
?>