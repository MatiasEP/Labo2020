
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $idReceta = isset($_POST["id"])?$_POST["id"]:'';
    try{
        
        if($idReceta != '')
        {
            $idReceta = new MongoDB\BSON\ObjectId($idReceta);
            $filter = ["idReceta"=>$idReceta];
            $options = ['projection'=>["_id"=>0, "calificaciones"=>1]];
            $query = new MongoDB\Driver\Query($filter,$options);
            $rows = $client->executeQuery("proyecto.calificaciones", $query); // $mongo contains the connection object to MongoDB    

            $total = 0;
            $contador = 0;
            foreach ($rows as $row) 
            {
                $calificaciones = $row->calificaciones;
                foreach($calificaciones as $calificacion)
                {                
                    $total +=  $calificacion->calificacion;
                    $contador ++;
                }
            }

            $total = $total/$contador;
            header('Content-Type: application/json');
            echo json_encode($total);
        }
         
    }
    catch(Exception $ex)
    {
        echo($ex);
    }

    
    
?>