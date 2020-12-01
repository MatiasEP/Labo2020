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

        <?php 

        include '../php/barras.php';
        
        $googleClient = new Google_Client();
        $auth = new GoogleAuth($googleClient);  

        $ctrl = new Operaciones();
        if(!$ctrl->isLoggedIn()){
            echo "<script>alert('no se encuentra logueado');window.location = 'http://localhost/Labo2020/paginas/mostrar todas las recetas.php';        </script>";
        }
        if(!(isset($_GET['id']) && $ctrl->editable($_GET['id']))){
          echo "<script>alert('no es el usuario creador');window.location = 'http://localhost/Labo2020/paginas/mostrar todas las recetas.php';        </script>";
        } 
        ?>

        <link rel="stylesheet" href="../estilos/estilos.css" type="text/css">
        <title>Editar receta</title>    
    </head>
    
    <body>
        <div class="container col-sm">
            <h1>Editar receta</h1><br><br>
            
            <form class="editar" method="post" action="../php/actualizar_receta.php" enctype="multipart/form-data">
                
                <input hidden="true" type="text" name="idReceta" id="idReceta" value="<?php echo $_GET['id'];?>"><br>
                
                <fieldset class="field-2">
                    <label for="titulo">Titulo: </label><br>
                    <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Ingrese el titulo..." minlength="3" maxlength="100" autofocus pattern="([A-Za-z]{1,}[\s]{0,1}){1,}" title="Introduzca solo letras" required><br>

                    <label >Foto de la receta: </label><br>
                    <img id="imgPrincipalPreview"src="" alt="Plato terminado" class="img-rounded"><br><br>

                    <label for="imgPrincipal" class="btn btn-warning">Cambiar imagen </label><br>
                    <input type="file" id="imgPrincipal" name="imgPrincipal" class="invisible" required><br>
                </fieldset>    
                
                <fieldset class="field-2">
                    <div id="listTipos"> </div>            
                    <h5>Ejemplos de tipos: Carnes, Vegetariano, Vegano, etc.</h5>
                    <input name="agregarTipo" class="btn btn-primary" id="agregarTipo" type="button" value="Agregar tipo" required> <br><br>
                </fieldset>
                
                <fieldset class="field-2">                    
                    <div id="listIngredientes"></div>
                    <input name="agregarIngrediente" class="btn btn-primary" id="agregarIngrediente" type="button" value="Agregar Ingrediente" required>
                </fieldset>
                    
                <fieldset class="field-2">                
                    <div id="listPasos"> </div>
                    <input name="agregarPaso" id="agregarPaso" class="btn btn-primary" type="button" value="Agregar Paso" required> <br>
                </fieldset>    

                <button name="guardar" class="btn btn-primary" id="btn_update_receta" type="submit">Actualizar receta</button>
                
            </form>
            
        </div>
    </body>
</html>