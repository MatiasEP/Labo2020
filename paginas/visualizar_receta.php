<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../estilos/visualizar_receta.css" type="text/css">
    <?php include '../php/barras.php';
        include '../php/get_comentarios.php';
        include '../php/visualizar_receta.php';?>
    <script type="text/javascript" src="../scripts/visualizar_receta.js" async></script>
    <script type="text/javascript" src="../scripts/get_comentarios.js" async></script>
    <script type="text/javascript" src="../scripts/agregar_comentario.js" async></script>
    <title>Inicio</title>
</head>
<body>
    <div class="container" >
        <h1 id="titulo"></h1><br><br>
        <img src="" alt="plato terminado" id="imgPrincipal"><br><br>
        <fieldset id="categorias">
            <legend>Categorias:</legend>
        </fieldset>
        <fieldset id="ingredientes">
            <legend>Ingredientes:</legend>
        </fieldset>
        <fieldset id="pasos">
            <legend>Pasos:</legend>
        </fieldset><br><br>
        <button id="favorito" class="agregar">Agregar a favoritos</button>
        <button id="descargar">Descargar como PDF</button>
        <fieldset id="comentarios">
            <legend>Comentarios:</legend>
            <div id="divComentarios">
            </div>
        </fieldset>
        <div class="" id="nuevoComentario">
        <label for="inputComentario"> Nuevo comentario: </label><br>
        <textarea name="inputComentario" id="inputComentario" cols="50" rows="5" placeholder="Ingrese su comentario..."></textarea><br>
        <button id="agregarComentario">Agregar comentario</button>
        </div>

    </div>

    
</body>
</html>