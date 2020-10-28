
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    if($idUsuario != '' and $idReceta !='')
    {
        $query = new BulkWrite();
        $query->update(['_idUsuario' => $idUsuario],
        ['$addset' => ['Recetas' => $idReceta]]);
        $client->executeBulkWrite("proyecto.favoritos",$bw);
    }
   
?>