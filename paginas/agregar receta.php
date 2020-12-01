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
        <!-- <link rel="stylesheet" href="./estilo.css" type="text/css"> -->
        <script src= "../scripts/agregar receta.js"></script>
        <?php include '../php/barras.php'; ?>
        <link rel="stylesheet" href="../estilos/agregar receta.css" type="text/css">   
        <title> Agregar receta </title>
    </head>

    <body>

        <h1 class="title-body"> Agregar Receta </h1><br><br>
        <div class="container col-sm">
            <form class="formulary" id="form" method="post" action="../php/agregar receta.php" enctype="multipart/form-data">
            
            <fieldset class="field-1">            
                <label for="titulo">Titulo: </label><br>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingrese el titulo..." minlength="3" maxlength="100" autofocus pattern="([A-Za-z]{1,}[\s]{0,1}){1,}" title="Introduzca solo letras" required><br>
                
                <label for="imgPrincipal"> Foto de la receta: </label><br>                
                <img id="imgPrincipalPreview"src="" alt="Plato terminado" class="oculto img-rounded"><br><br>
                <label for="imgPrincipal" class="btn btn-warning">Seleccionar imagen </label><br>
                
                <input autocomplete="off" class="invisible" autofocus value="" type="file" id="imgPrincipal" name="imgPrincipal" required><br>
            </fieldset>
                
            <fieldset class="field-1">
                <div id="listTipos">
                    <div >
                        <label for="tipo"> Tipo: </label><br>
                        <select class="form-control" name="tipo[]" id="tipo" required>
                        </select><br><br>
                    </div>
                </div>
                
                <h5>Ejemplos de tipos: Carnes, Vegetariano, Vegano, etc.</h5>
                <input name="agregarTipo" class="btn btn-primary" id="agregarTipo" type="button" value="Agregar tipo" ><br><br>
            </fieldset>
            
            <fieldset class="field-1">
                <div id="listIngredientes">
                    <label for="ingrediente">Ingrediente: </label><br>
                    <input class="form-control" autocomplete="off" autofocus value="" type="text" name="ingrediente[]" placeholder="Ingrese un ingrediente..." minlength="3" maxlength="50" pattern="([A-Za-z]{1,}[\s]{0,1}){1,}" required><br>
                    
                    <label for="cantidad">Cantidad</label><br>
                    <input class="form-control" autocomplete="off" autofocus value="" type="text" name="cantidad[]" maxlength="100" required placeholder="Ingrese una cantidad..."><br><br>
                </div>  
                <input name="agregarIngrediente" class="btn btn-primary" id="agregarIngrediente" type="button" value="Agregar Ingrediente" ><br><br>
            </fieldset>
                
            <fieldset class="field-1">            
                <div id="listPasos">
                    <div id="paso0">
                        <label for="paso">Paso: </label><br>
                        <input id="paso" class="form-control" autocomplete="off" autofocus value="" type="text" name="paso[]" placeholder="Ingrese el paso (ej: 1# paso:...)" autofocus minlength="10" maxlength="150" pattern="([1-9]{0,1}[\\0-9][\#][\s][\\p][\\a][\\s][\\o][\\:][\s]([a-zA-Z,. ]{1,}[\s])){1,}" required><br>
                        
                        <label >Imagen: </label><br>
                        <img id="imgPasoPreview0"src="" class="oculto img-rounded"><br><br>
                        
                        <label for="imagen0" class="btn btn-warning">Seleccionar imagen</label><br>
                        <input class="invisible" id="imagen0"autocomplete="off" autofocus value="" type="file" name="imagen[]"><br>
                    </div>
                </div>
                
                <input name="agregarPaso" class="btn btn-primary" id="agregarPaso" type="button" value="Agregar Paso" ><br><br>   
            </fieldset>    
            <button type="submit" name="guardar" class="btn btn-primary" id="btn_guardar_receta"> Guardar receta </button><br>
            
        </form>            
        </div>    
        
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">La receta se agrego correctamente</h4>
                    </div>
                    <div class="modal-body centrado">
                        <img class="img-responsive ok" src="../imagenes/ok.png" alt="">
                         <br><br>
                        <a href="../paginas/mostrar%20recetas%20por%20usuario.php" id="misRecetasModal">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class="glyphicon glyphicon-ok"></span>Aceptar
                        </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>