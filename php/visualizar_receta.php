<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $id = isset($_GET["id"])?$_GET["id"]:'';

    if($id !='')
    {            
        $id = new MongoDB\BSON\ObjectId($id);
        $filter = ["_id"=>$id];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.recetas", $query); // $mongo contains the connection object to MongoDB    

        $array = array();
        foreach ($rows as $row) 
        {
            array_push($array, $row);
        }
        header('Content-type: application/json');
        echo json_encode($array);

    }
    
?>