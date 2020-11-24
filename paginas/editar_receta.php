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
    <script src= "../scripts/agregar receta.js"></script>
    <script src= "../scripts/editar_receta.js"></script>
    <?php include '../php/barras.php';
    include '../php/visualizar_receta.php';
        ?>
    <link rel="stylesheet" href="../estilos/estilos.css" type="text/css">
    <title>Editar receta</title>
    

</head>
<body>
    <div class="container-fluid">
        <h1>Editar receta</h1><br><br>
        <form class="editar" method="post" action="../php/actualizar_receta.php" enctype="multipart/form-data">
            <label for="titulo">Titulo: </label><br>
            <input type="text" name="titulo" id="titulo" placeholder="Ingrese el titulo..."><br>
            <label >Foto de la receta: </label><br>
            <img id="imgPrincipalPreview"src="" alt="Plato terminado"><br><br>
            <label for="imgPrincipal" class="btn btn-primary">Cambiar imagen </label><br>
            <input type="file" id="imgPrincipal" name="imgPrincipal" class="invisible"><br>
            <div id="listTipos">
            </div>
            <h5>Ejemplos de tipos: Carnes, Vegetariano, Vegano, etc.</h5>
            <input name="agregarTipo" id="agregarTipo" type="button" value="Agregar tipo" ></button><br><br>
            <div id="listIngredientes">
            </div>        
            <input name="agregarIngrediente" id="agregarIngrediente" type="button" value="Agregar Ingrediente" ></button><br><br>
            <div id="listPasos">
            </div>
            <input name="agregarPaso" id="agregarPaso" class="btn btn-primary" type="button" value="Agregar Paso" ></button><br><br>
            <button name="guardar" type="submit">Actualizar receta</button>
        </form>
    </div>
    </body>
</html>