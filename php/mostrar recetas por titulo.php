<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    use \MongoDB\Driver\Aggregate;
    use \MongoDB\Driver\Command;
    $titulo = isset($_GET["busqueda"])?$_GET["busqueda"]:'';
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    if($titulo != '')
    {
            
        $command = new MongoDB\Driver\command([
            'aggregate' => 'recetas',
            'pipeline' => [['$search'=>[
                "index"=>"busquedaPorTitulo",
                "search"=>[
                    "path"=>"titulo",
                    "query"=>$titulo
                ],
                "highlight"=>[
                    "path"=>"titulo"
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