
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idUsuario = "5fa1f37a25700000930007ed"; //temporal para test
    if($idUsuario != '' )
    {                
        $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);       
        $query = new BulkWrite();
        $query->update(["_id"=>$idUsuario],
        ['$set' => ['visible' => false]]);
        $client->executeBulkWrite("proyecto.usuarios",$query);
    }
   
?>