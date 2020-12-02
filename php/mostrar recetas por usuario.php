
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
        $filter = ["_idCreador"=>$id];
        $options = ['sort' =>['_id'=>-1],];
        $query = new MongoDB\Driver\Query($filter,$options);
        $rows = $client->executeQuery("proyecto.recetas", $query); // $mongo contains the connection object to MongoDB
         /*$file = '../json/mostrar recetas por ingredientes.json';
        if(file_exists($file))
        {        
            unlink($file);
        }
        //file_put_contents($file,"[",FILE_APPEND | LOCK_EX);*/
        $array = array();
        foreach ($rows as $row) 
        {
            //$json_string = json_encode($row);
            if($row->visible)
            {                
                array_push($array, $row);
            }
        }
        header('Content-type: application/json');
        echo json_encode($array);
        /*$array = implode(',',$array);
        file_put_contents($file, "[",FILE_APPEND | LOCK_EX);
        file_put_contents($file, $array,FILE_APPEND | LOCK_EX);
        file_put_contents($file, "]",FILE_APPEND | LOCK_EX);*/
    }else{
	echo "redireccionar al iniciio";
	}
    
?>