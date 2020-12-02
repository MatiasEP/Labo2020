
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $idCreador = isset($_POST["id"])?$_POST["id"]:'';
    
    if($idCreador != '')
    {
        $idCreador = new MongoDB\BSON\ObjectId($idCreador);
        $filter = ["_id"=>$idCreador];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.usuarios", $query); // $mongo contains the connection object to MongoDB    

        $array = array();
        foreach ($rows as $row) 
        {
            array_push($array, $row);
        }
        header('Content-Type: application/json');
        echo json_encode($array);
    }
    
?>