
<?php

    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();
    $idUsuario =  $ctrl->getUserInfo()->_id->__toString();
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
            $query3 = new BulkWrite();
            $query3->update(["idReceta"=>$idReceta],
            ['$set' => ['observado' => true]]);
            $client->executeBulkWrite("proyecto.reportes",$query3);
        }
    }
   
?>