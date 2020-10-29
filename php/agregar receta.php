<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./estilo.css" type="text/css">
    <script src= "./script.js"></script>
    <title>Document</title>
    

</head>
<body>
<?php
    use \MongoDB\Driver\BulkWrite;
    use \MongoDB\Driver\Query;
    $client = new MongoDB\Driver\Manager(sprintf(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
    $query = new MongoDB\Driver\BulkWrite;
    $idUsuario = isset($_POST["idUsuario"])?$_POST["idUsuario"]:'';
    $idUsuario = 3;//provisional para test
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
        $query->insert(["_idCreador"=>$idUsuario,"titulo"=>$_POST["titulo"],"imagen"=>$ruta,"tipo"=>$tipos,"ingredientes"=>$arrayIngredientes,"pasos"=>$arrayPasos,"activado"=>FALSE,"visible"=>FALSE]);
        $result = $client->executeBulkWrite("proyecto.recetas",$query);
    }
    ?>
    <h1>Agregar receta</h1><br><br>
    <form method="post" action="./agregar receta.php" enctype="multipart/form-data">
        <label for="titulo">Titulo: </label><br>
        <input type="text" name="titulo" id="titulo" placeholder="Ingrese el titulo..."><br>
        <label for="imgPrincipal">Foto de la receta: </label><br>
        <input autocomplete="off" autofocus value="" type="file" id="imgPrincipal" name="imgPrincipal"><br>
        <div id="listTipos">
            <label for="tipo">Tipo: </label><br>
            <input type="text" name="tipo" id="tipo" placeholder="Ingrese un tipo..."><br><br>
        </div>
        <h5>Ejemplos de tipos: Carnes, Vegetariano, Vegano, etc.</h5>
        <input name="agregarTipo" id="agregarTipo" type="button" value="Agregar tipo" ></button><br><br>
        <div id="listIngredientes">
            <label for="ingrediente">Ingrediente: </label><br>
            <input autocomplete="off" autofocus value="" type="text" name="ingrediente[]" placeholder="Ingrese un ingrediente..."><br>
            <label for="cantidad">Cantidad</label><br>
            <input autocomplete="off" autofocus value="" type="text" name="cantidad[]"><br><br>
        </div>        
        <input name="agregarIngrediente" id="agregarIngrediente" type="button" value="Agregar Ingrediente" ></button><br><br>
        <div id="listPasos">
            <label for="paso">Paso: </label><br>
            <input autocomplete="off" autofocus value="" type="text" name="paso[]" placeholder="Ingrese un paso..."><br>
            <label for="imagen">Imagen: </label><br>
            <input autocomplete="off" autofocus value="" type="file" name="imagen[]"><br><br>
        </div>
        <input name="agregarPaso" id="agregarPaso" type="button" value="Agregar Paso" ></button><br><br>
        <button name="guardar" type="submit">Guardar lista</button>
    </form>
    </body>
</html>