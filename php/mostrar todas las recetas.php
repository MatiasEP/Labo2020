
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    
    $filter = [];
    $options = ['sort' =>['_id'=>-1],];
    $query = new MongoDB\Driver\Query($filter,$options);
    $rows = $client->executeQuery("proyecto.recetas", $query); // $mongo contains the connection object to MongoDB    
    $file = '../json/mostrar todas las recetas.json';
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
    /*foreach($rows as $row)
    {                    
        $json_string = json_encode($row);
        file_put_contents($file, $json_string,FILE_APPEND | LOCK_EX);
    }
    file_put_contents($file,"]",FILE_APPEND | LOCK_EX);*/
    /*foreach ($rows as $row) {
        $bson = MongoDB\BSON\fromPHP($row);
        echo MongoDB\BSON\toJSON($bson), "\n";
    }*/
    //echo MongoDB\BSON\toJSON($rows), "\n";
    /*foreach($rows as $r)
    {
        echo("<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>");
        echo("<div class='panel panel-primary' >");    
        echo("<div class='panel-heading'>".$r->titulo."</div>");
        echo("<div class='panel-body' >");        
        echo("<img src=".$r->imagen." class='thumbnail' alt='no tenia fotos de culo''>");
        echo("<div class='panel-footer' >Tipo: ");
        foreach($r->tipo as $tipo)
        {       
            echo(" ".$tipo." ");
        }
        echo("</div>");
        echo("</div>");
        echo("</div>");
        echo("</div>");
    }*/
?>