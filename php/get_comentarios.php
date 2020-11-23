
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $id = isset($_GET["id"])?$_GET["id"]:'';
    if($id != '')
    {        

        

        $command = new MongoDB\Driver\command([
            'aggregate' => 'comentarios',
            'pipeline' => [['$lookup'=>[
                
                    "from"=> 'usuarios',
                    "localField"=> 'idUsuario',
                    "foreignField"=> '_id',
                    "as"=> 'usuario'
                ] 
                ]],
                'cursor' => new stdClass()
            ]);
        $rows = $client->executeCommand('proyecto', $command);
        /*$id = new MongoDB\BSON\ObjectId($id);
        $filter = ["idReceta"=>$id];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.comentarios", $query); // $mongo contains the connection object to MongoDB  */  
        $file = '../json/comentarios.json';
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