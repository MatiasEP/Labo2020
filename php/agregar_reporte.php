
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $reporte = isset($_POST["reporte"])?$_POST["reporte"]:'';
    $idReceta = "5fa58577bd0d000028004567";//temporal para test
    $idUsuario = "5fa1f37a25700000930007ed"; //temporal para test
    if($idUsuario != '' and $idReceta !='' and $reporte !='')
    {
        $idReceta = new MongoDB\BSON\ObjectId($idReceta);        
        $idUsuario = new MongoDB\BSON\ObjectId($idUsuario);    
        $query = new MongoDB\Driver\BulkWrite;
        $query->insert(["idReceta"=>$idReceta,"idUsuario"=>$idUsuario,"reporte"=>$reporte]);
        $result = $client->executeBulkWrite("proyecto.reportes",$query);
    }
   
?>