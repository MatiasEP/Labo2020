
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    
    $filter = [];
    $options = ['sort' =>['_id'=>-1],];
    $query = new MongoDB\Driver\Query($filter,$options);
    $rows = $client->executeQuery("proyecto.categorias", $query); // $mongo contains the connection object to MongoDB    

    $array = array();
    foreach ($rows as $row) 
    {
        array_push($array, $row);
    }
	header('Content-Type: application/json');
	echo json_encode($array);
?>