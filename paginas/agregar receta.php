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
    <script src= "../scripts/agregar receta.js"></script>
    <?php include '../php/barras.php';
        ?>
    <title>Agregar receta</title>
    

</head>
<body>
    
    <h1>Agregar receta</h1><br><br>
    <form method="post" action="../php/agregar receta.php" enctype="multipart/form-data">
        <label for="titulo">Titulo: </label><br>
        <input type="text" name="titulo" id="titulo" placeholder="Ingrese el titulo..."><br>
        <label for="imgPrincipal">Foto de la receta: </label><br>
        <input autocomplete="off" autofocus value="" type="file" id="imgPrincipal" name="imgPrincipal"><br>
        <div id="listTipos">
            <div >
                <label for="tipo">Tipo: </label><br>
                <select name="tipo[]" id="tipo">
                </select><br><br>
            </div>
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
        <button name="guardar" type="submit">Guardar receta</button>
    </form>
    </body>
</html>