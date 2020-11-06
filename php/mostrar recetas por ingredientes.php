<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $ingrediente = isset($_POST["busqueda"])?$_POST["busqueda"]:'';
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
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
        $file = '../json/mostrar recetas por ingredientes.json';
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