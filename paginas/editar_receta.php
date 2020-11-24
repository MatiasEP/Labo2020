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
    include '../php/get_categorias.php';?>
    <link rel="stylesheet" href="../estilos/agregar%20receta.css" type="text/css">
    
    <title>Editar receta</title>
    

</head>
<body>
    <div class="container col-sm">
        <h1 class="title-body">Editar receta</h1><br><br>
        
        <form class="formulary editar" method="post" action="../php/actualizar_receta.php" enctype="multipart/form-data">
            
            <fieldset class="field-2">  
                <label for="titulo">Titulo: </label><br>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Ingrese nuevo titulo..." minlength="3" maxlength="70" required> <br><br>
            </fieldset>    
            
            <fieldset class="field-2">  
                <label >Foto de la receta: </label><br>
                <img id="imgPrincipalPreview"src="" alt="Plato terminado"><br><br>
                <label for="imgPrincipal" class="botonImg btn btn-warning">Cambiar imagen </label><br>
            </fieldset>    
            
            <input type="file" id="imgPrincipal" name="imgPrincipal" class="d-none" style='display: none;' required><br>
            
            <fieldset class="field-2">  
                <div id="listTipos"></div>
                <h5>Ejemplos de tipos: Carnes, Vegetariano, Vegano, etc.</h5>
                <input name="agregarTipo" class="btn btn-primary" id="agregarTipo" type="button" value="Agregar tipo"> <br><br>
            </fieldset>
                
            <div id="listIngredientes"></div> 
            
            <input name="agregarIngrediente" class="btn btn-primary" id="agregarIngrediente" type="button" value="Agregar Ingrediente" ><br><br>
            
            <div id="listPasos"></div>
            
            <input name="agregarPaso" class="btn btn-primary" id="agregarPaso" type="button" value="Agregar Paso" > <br><br>
            <button name="guardar" class="btn btn-primary" type="submit">Actualizar receta</button> <br>
        </form>
        
    </div>
    </body>
</html>