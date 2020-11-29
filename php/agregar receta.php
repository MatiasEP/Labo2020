
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;

    $googleClient = new Google_Client();
    $auth = new GoogleAuth($googleClient);  

    $ctrl = new Operaciones();
    if(!$ctrl->isLoggedIn()){
        echo "<script>alert('no se encuentra logueado');window.location = 'http://localhost/Labo2020/paginas/mostrar todas las recetas.php';        </script>";

    }
    $client = new MongoDB\Driver\Manager(sprintf(DB::urlConn()));
    $query = new MongoDB\Driver\BulkWrite;
    $idUsuario =$ctrl->getUserInfo()->_id;
    //$idUsuario = 3;//provisional para test
    $contadorPasos=0;
    $contadorIngredientes=0;
    $pasos = [];// La lista de pasos; por defecto vacía
    $imagenes = [];// La lista de imagenes; por defecto vacía
    $ingredientes = [];// La lista de pasos; por defecto vacía
    $cantidades = [];// La lista de imagenes; por defecto vacía
    $tipos=[];
    $arrayPasos=[];
    $arrayIngredientes=[];
    $imgPrincipal= (isset($_FILES['imgPrincipal'])?$_FILES['imgPrincipal']:'');
    
    //var_dump($_FILES);
	if(isset($_FILES['imgPrincipal'])){
		$imgPrincipalb64 = createBase64($_FILES['imgPrincipal']); 
	}
    class ingrediente
    {
        public $descripcion;
        public $cantidad;
    }
    class paso
    {
        public $descripcion;
        public $imagen;
    }
    /*echo '<pre>';
    //print_r($_FILES);
    echo '</pre>';*/
    # Si hay nombres enviados por el formulario; entonces
    # la lista es el formulario.
    # Cada que lo envíen, se agrega un elemento a la lista
    if (isset($_POST["paso"])) 
    {
        $pasos = $_POST["paso"];
    }
    if (isset($_FILES["imagen"])) 
    {
        $imagenes = $_FILES["imagen"];
        if(is_array($imagenes['name'])){
            $contadorPasos = count($imagenes['name']);
        }else{
            $contadorPasos = 1;
        }

       
    }
    if (isset($_POST["ingrediente"])) 
    {
        $ingredientes = $_POST["ingrediente"];
        $contadorIngredientes = (count($ingredientes));
    }
    if (isset($_POST["cantidad"])) 
    {
        $cantidades = $_POST["cantidad"];
    }
    if (isset($_POST["tipo"])) 
    {
        $tipos = $_POST["tipo"];
    }
    # Detectar cuál botón fue presionado
    # En caso de que haya sido el de guardar, no agregamos más campos
    if (isset($_POST["guardar"])) 
    {        
        
        for($i = 0; $i<$contadorPasos;$i++)
        {
            $ruta = "../imagenes/".$imagenes['name'][$i];
            //move_uploaded_file($imagenes['tmp_name'][$i],$ruta);
			
			
        }
        $ruta = "../imagenes/".$imgPrincipal['name'];
        //move_uploaded_file($imgPrincipal['tmp_name'],$ruta);
        for($i=0; $i < $contadorIngredientes; $i++)
        {
            $obj = new ingrediente();
            $obj->descripcion = $ingredientes[$i];
            $obj->cantidad = $cantidades[$i];
            array_push($arrayIngredientes, $obj);
        }
        if($contadorPasos == 1 ){
            $obj = new paso();
            $obj->descripcion = $pasos[0];

            $obj->imagen = createBase640($_FILES['imagen']);
            //$obj->imagen = createBase64Tmp($_FILES["imagen"],0);

            array_push($arrayPasos, $obj);
        }else{
            for($i=0; $i < $contadorPasos; $i++)
            {
                $obj = new paso();
                $obj->descripcion = $pasos[$i];
                $obj->imagen = createBase64Tmp($_FILES["imagen"],$i);
    
                array_push($arrayPasos, $obj);
            }
        }
        $query->insert(["_idCreador"=>$idUsuario,"titulo"=>$_POST["titulo"],"imagen"=>$imgPrincipalb64,"tipo"=>$tipos,"ingredientes"=>$arrayIngredientes,"pasos"=>$arrayPasos,"activado"=>FALSE,"visible"=>FALSE]);
        $result = $client->executeBulkWrite("proyecto.recetas",$query);
        echo json_encode(true);
                


    }
    function createBase64($file){
        $data = file_get_contents($file['tmp_name']);
        $data = base64_encode($data);
        return "data:image/gif;base64,".$data;
    }
    function createBase640($file){
        $data = file_get_contents($file['tmp_name'][0]);
        $data = base64_encode($data);
        return "data:image/gif;base64,".$data;
    }
function createBase64Tmp($fileTmp,$ii){
	$data = file_get_contents($fileTmp['tmp_name'][$ii]);
	$data = base64_encode($data);
	return "data:image/gif;base64,".$data;
}


    ?>

