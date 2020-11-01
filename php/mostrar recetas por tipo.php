<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $ingrediente = isset($_POST["ingrediente"])?$_POST["ingrediente"]:'';
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $ingrediente = isset($_POST["tipo"])?$_POST["tipo"]:'';
    $ingrediente = "culo";//provisorio para test
    if($ingrediente !='')
    {            
        $filter = ["tipo"=>$ingrediente];
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