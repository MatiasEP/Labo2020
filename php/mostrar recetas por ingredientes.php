<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $ingrediente = isset($_GET["busqueda"])?$_GET["busqueda"]:'';
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

        $array = array();
        foreach ($rows as $row) 
        {
            if($row->visible && $row->activado)
            {
                array_push($array, $row);
            }
        }
        header('Content-type: application/json');

        echo json_encode($array);
    }
    
?>