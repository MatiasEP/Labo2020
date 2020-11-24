
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $idReceta = "5fa58577bd0d000028004567";
    $idUsuario = "5fa1f37a25700000930007ed"; //temporal para test
    if($idUsuario != '' and $idReceta !='')
    {        
        $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
        $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
        $filter = ["_idUsuario"=>$idUsuario, "Recetas"=>$idReceta];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.favoritos", $query);
        $res = $rows->toArray();
        $count = count($res);
        if($count == 0)
        {            
            $query2 = new BulkWrite();
            $query2->update(['_idUsuario' => $idUsuario],
            ['$push' => ['Recetas' => $idReceta]]);
            $client->executeBulkWrite("proyecto.favoritos",$query2);
        }
    }
   
?>