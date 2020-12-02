
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
	require_once("../app/clases/operaciones.php");
	require_once("../app/init.php");
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    use \MongoDB\Driver\ReadPreference;
    $id = isset($_GET["id"])?$_GET["id"]:'';
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    if($id == '')
    {
  	$googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  
    $ctrl = new Operaciones();
    $id =  $ctrl->getUserInfo()->_id->__toString();

    }

	if($id != '')
    {
        $id = new MongoDB\BSON\ObjectId($id);
        $filter = ["_idUsuario"=>$id];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.favoritos", $query); // $mongo contains the connection object to MongoDB
        $array = array();
        foreach($rows as $r)
        {
            foreach($r->Recetas as $idReceta)
            {
                $filter2 = ["_id"=>$idReceta];
                $options2 = ['sort' =>['_id'=>-1],];
                $query2 = new MongoDB\Driver\Query($filter2,$options2);
                $rows2 = $client->executeQuery("proyecto.recetas", $query2);   
                
                foreach ($rows2 as $r2) 
                {
                    if($r2->visible and $r2->activado)
                        {    
                            array_unshift($array, $r2);
                        }
                }
            }
        }
        header('Content-type: application/json');
        echo json_encode($array);

        
                    
    }else{
	echo "redireccionar al iniciio";
	}
    
?>