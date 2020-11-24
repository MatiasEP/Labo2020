<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $categoria = isset($_GET["categoria"])?$_GET["categoria"]:'';
    if($categoria !='')
    {            
        $filter = ["tipo"=>$categoria];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.recetas", $query); // $mongo contains the connection object to MongoDB    
        $file = '../json/mostrar recetas por tipo.json';
        if(file_exists($file))
        {        
            unlink($file);
        }
        //file_put_contents($file,"[",FILE_APPEND | LOCK_EX);
        $array = array();
        foreach ($rows as $row) 
        {
            $json_string = json_encode($row);
            array_push($array, $json_string);
        }
        $array = implode(',',$array);
        file_put_contents($file, "[",FILE_APPEND | LOCK_EX);
        file_put_contents($file, $array,FILE_APPEND | LOCK_EX);
        file_put_contents($file, "]",FILE_APPEND | LOCK_EX);
    }
    
?>