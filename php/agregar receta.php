
<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;

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

    $carga = false;
    if(isset($_POST['receta'])){
        $receta = $_POST["receta"];
        $titulo= $receta["titulo"];
        $imgPrincipal = $receta["imgPrincipal"];
        $ingredientes = $receta["ingredientes"];
        $cantidades = $receta["cantidad"];
        $pasos = $receta["paso"];
        $tipos = $receta["tipos"];
        
        $imgPasos = $receta["imgPaso"];
        $carga = $receta["carga"];
        
        $contadorIngredientes = (count($ingredientes));
        $contadorPasos= (count($pasos));

    }
    
    if (isset($carga)) 
    {        
        
        for($i=0; $i < $contadorIngredientes; $i++)
        {
            $obj = new ingrediente();
            $obj->descripcion = $ingredientes[$i];
            $obj->cantidad = $cantidades[$i];
            array_push($arrayIngredientes, $obj);
        }
        for($i=0; $i < $contadorPasos; $i++)
        {
            $obj = new paso();
            $obj->descripcion = $pasos[$i];
            $obj->imagen =$imgPasos[$i];

            array_push($arrayPasos, $obj);
        }
        $query->insert(["_idCreador"=>$idUsuario,"titulo"=>$titulo,"imagen"=>$imgPrincipal,"tipo"=>$tipos,"ingredientes"=>$arrayIngredientes,"pasos"=>$arrayPasos,"activado"=>FALSE,"visible"=>FALSE]);
        $result = $client->executeBulkWrite("proyecto.recetas",$query);
        echo json_encode(true);

    }else{
        echo json_encode(false);
        
    }


    ?>

