
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idReceta = isset($_POST["idReceta"])?$_POST["idReceta"]:'';
    $idReceta = "5fa58577bd0d000028004567";
    $idUsuario = "5fa1f37a25700000930007ed"; //temporal para test
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
    print_r($_FILES);
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
        $contadorPasos = (count($imagenes['name']));
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
            move_uploaded_file($imagenes['tmp_name'][$i],$ruta);
        }
        $ruta = "../imagenes/".$imgPrincipal['name'];
        move_uploaded_file($imgPrincipal['tmp_name'],$ruta);
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
            $obj->imagen = "../imagenes/".$imagenes['name'][$i];
            array_push($arrayPasos, $obj);
        }
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
            ['$set' => ["titulo"=>$_POST["titulo"],"imagen"=>$ruta,"tipo"=>$tipos,"ingredientes"=>$arrayIngredientes,"pasos"=>$arrayPasos]]);
            $client->executeBulkWrite("proyecto.recetas",$query2);
        }
    }
   
?>