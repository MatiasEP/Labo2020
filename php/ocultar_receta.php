
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $idReceta = "5fa58577bd0d000028004567";
    $idUsuario = "5fa1f37a25700000930007ed"; //temporal para test
    if($idUsuario != '' and $idReceta !='')
    {        
        $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
        $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);
        $filter = [ "_id"=>$idReceta,"_idCreador"=>$idUsuario];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.recetas", $query);
        $res = $rows->toArray();
        $count = count($res);
        if($count != 0)
        {            
            $query2 = new BulkWrite();
            $query2->update(["_id"=>$idReceta,'_idCreador' => $idUsuario],
            ['$set' => ['visible' => false]]);
            $client->executeBulkWrite("proyecto.recetas",$query2);
        }
    }
   
?>