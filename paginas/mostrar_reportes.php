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
    <link rel="stylesheet" href="../estilos/mostrar todas las recetas.css" type="text/css">
    <script src="../scripts/get_reportes.js" async></script>
    <?php include '../php/barras.php';?>
    <title>Inicio</title>
</head>
<body>
    <div class="container" >
        <div class="row" id="main">

        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Datos del reporte</h4>
                </div>
                <div class="modal-body">
                <h4>Motivo: </h4><br>
                        <div class="form-group">
                            <textarea name="motivo" id="motivo" cols="50" rows="5"  disabled></textarea><br>
                        </div>
                        <div class="btn-group">
                            <a href="" class="btn btn-primary " id="verReceta">
                                <span class="glyphicon glyphicon-send"></span> Ir a receta
                            </a>  
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="ignorarReceta">
                            <span class="glyphicon glyphicon-remove"></span>Ignorar
                            </button>
                        </div>
            </div>
        </div>
    </div>
</body>
</html>