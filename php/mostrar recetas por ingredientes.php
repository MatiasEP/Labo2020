<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $ingrediente = isset($_POST["busqueda"])?$_POST["busqueda"]:'';
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    if($ingrediente !='')
    {   
        $command = new MongoDB\Driver\command([
        'aggregate' => 'recetas',
        'pipeline' => [['$search'=>[
            "index"=>"BusquedaIngredientes",
            "search"=>[
                "path"=>"ingredientes.descripcion",
                "query"=>$ingrediente
            ],
            "highlight"=>[
                "path"=>"ingredientes.descripcion"
            ]]
            ]],
            'cursor' => new stdClass()
        ]);
        $rows = $client->executeCommand('proyecto', $command);  
       // $file = '../json/mostrar recetas por ingredientes.json';
       // if(file_exists($file))
       // {        
       //     unlink($file);
       // }
        //file_put_contents($file,"[",FILE_APPEND | LOCK_EX);
        $array = array();
        foreach ($rows as $row) 
        {
        //    $json_string = json_encode($row);
            array_push($array, $row);
        }
        header('Content-type: application/json');

        echo json_encode($array);
        //$array = implode(',',$array);
        //file_put_contents($file, "[",FILE_APPEND | LOCK_EX);
        //file_put_contents($file, $array,FILE_APPEND | LOCK_EX);
       // file_put_contents($file, "]",FILE_APPEND | LOCK_EX);
    }
    
?>