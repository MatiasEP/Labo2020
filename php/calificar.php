
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");

    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));

    class calificacion
    {
        public $idUsuario;
        public $calificacion;
    }

    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();

    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $calificacion = isset($_POST["calificacion"])?$_POST["calificacion"]:'';
    $idUsuario =  $ctrl->getUserInfo()->_id;

    try{
        $idReceta = new MongoDB\BSON\ObjectId($idReceta);
        $obj = new calificacion();
        $obj->idUsuario = $idUsuario;
        $obj->calificacion = $calificacion; 
        
        $filter = ["idReceta"=>$idReceta,"calificaciones"=>['$elemMatch'=>["idUsuario"=>$idUsuario]]];
        $options = ['projection'=>["_id"=>0, "calificaciones"=>1]];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.calificaciones", $query); // $mongo contains the connection object to MongoDB 
        $res = $rows->toArray();
        $count = count($res);
        if($count == 0)
        {           
            $query2 = new BulkWrite();
            $query2->update(['idReceta' => $idReceta],
            ['$push' => ['calificaciones' => $obj]]);
            $client->executeBulkWrite("proyecto.calificaciones",$query2);
        }
        else
        {
            $query2 = new BulkWrite();
            $query2->update(['calificaciones.idUsuario' => $idUsuario],
            ['$set' => ['calificaciones.$.calificacion' => $calificacion]]);
            $client->executeBulkWrite("proyecto.calificaciones",$query2);
        }
         
    }
    catch(Exception $ex)
    {
        echo($ex);
    }
        
   
?>