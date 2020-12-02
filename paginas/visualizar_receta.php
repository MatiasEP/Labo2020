<!DOCTYPE html>
<?php 

    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
    $ctrl = new Operaciones();
    $urlCompartir= $_SERVER["REQUEST_URI"];
    $idCompartir= $_GET["id"];
	$tituloCompartir="compartir receta	";
    
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:url"           content="http://localhost/<?php  echo $urlCompartir;?>" />
        <meta property="og:type"          content="Recetas" />
        <meta property="og:title"         content="<?php echo $tituloCompartir;?>" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../estilos/visualizar_receta.css" type="text/css">

        <?php include '../php/barras.php'; ?>
        <script type="text/javascript" src="../scripts/visualizar_receta.js" async></script>
        <script type="text/javascript" src="../scripts/get_comentarios.js" async></script>
        <script type="text/javascript" src="../scripts/agregar_comentario.js" async></script>
        <script type="text/javascript" src="../scripts/reportar_receta.js" async></script>
        <title>Inicio</title>
    </head>
    
    <body>
        
        <div class="container">

            <div class="container-view ">
                <h1 id="titulo"></h1><br><br>
                
                <fieldset class="field-3 field-primary">
                    <img src="" alt="plato terminado" class="img-rounded" id="imgPrincipal"><br>
                </fieldset>    

                <fieldset class="field-3" id="categorias">
                    <legend>Categorias:</legend>
                </fieldset>

                <fieldset class="field-3" id="ingredientes">
                    <legend>Ingredientes:</legend>
                </fieldset>

                <fieldset class="field-3" id="pasos">
                    <legend>Pasos:</legend>
                </fieldset><br>
                
                <fieldset class="field-3 creador" id="creador">
                    <legend>Creador:</legend>
                    <a id="zeldaCreador" href=""><img class='img-circle perfil' id="imgCreador" src=''></a><br><br>
                    <button class="btn btn-primary"  id="btnCreador">             
                        <span class="glyphicon glyphicon-eye-open" id="seguirCreador"></span>
                    </button>
                </fieldset>

                <fieldset class="field-3">   
                    <h3 id="calActual">La calificacion actual es:  </h3> <br>
                    <div class="" id="calificar">
                        <h4>Calificar receta:</h4><br>
                        <button class="btn btn-warning" id="cal1" >1 <span class="glyphicon glyphicon-star"></button>
                        <button class="btn btn-warning" id="cal2" >2 <span class="glyphicon glyphicon-star"></button>
                        <button class="btn btn-warning" id="cal3" >3 <span class="glyphicon glyphicon-star"></button>
                        <button class="btn btn-warning" id="cal4" >4 <span class="glyphicon glyphicon-star"></button>
                        <button class="btn btn-warning" id="cal5" >5 <span class="glyphicon glyphicon-star"></button>
                        <br><br>
                    </div>            
                    <button class="btn btn-primary" id="favorito" class="agregar">Agregar a favoritos</button>
                    <button class="btn btn-primary" id="descargar">Descargar como PDF</button>

                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                        <span class="glyphicon glyphicon-exclamation-sign"> Reportar receta</span>
                    </a>

                    <div id="fb-root"></div>

                    <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                    fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>

                    <?php if ($ctrl->isLoggedIn()): ?>  

                    <a href="http://localhost/Labo2020/paginas/editar_receta.php?id=<?php echo $_GET['id'];?>" target="_blank"> Editar Receta </a>

                    <br>        
                    <?php endif; ?>

                    <!-- Your share button code -->
                    <div class="fb-share-button" data-href="http://localhost/<?php echo $urlCompartir;?>" data-layout="button_count">
                    </div>

                    <a href="https://twitter.com/intent/tweet?text=recetas compartidas&url=http%3A%2F%2Flocalhost%2FLabo2020%2Fpaginas%2Fvisualizar_receta.php?id=<?php echo $idCompartir;?>&via=labo2020&hashtags=recetas" target="_blank">Twittear</a>
                </fieldset>
                    
                <br>
                <fieldset class="field-3" id="comentarios">
                    <legend>Comentarios:</legend>
                    <div id="divComentarios">
                    </div>
                </fieldset>

                <?php if ($ctrl->isLoggedIn()): ?>  

                <fieldset class="field-3">
                    <div class="" id="nuevoComentario">
                        <label for="inputComentario"> Nuevo comentario: </label><br>
                        <textarea name="inputComentario" class="form-control" id="inputComentario" cols="40" rows="8" placeholder="Ingrese su comentario (solo hasta 250 caracteres)" minlength="2" maxlength="250"></textarea><br>
                        <button class="btn btn-primary" id="agregarComentario">Agregar comentario</button> <br><br>
                        <span id="comError"></span>
                    </div>
                </fieldset>    
                <?php endif; ?>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Reportar receta</h4>
                        </div>
                        <div class="modal-body">
                            <form id="formReporte" action="">
                                <div class="form-group">
                                    <label for="reporte">Reporte</label>
                                    <textarea name="reporte" class="form-control" id="reporte" cols="40" rows="8" placeholder="Ingrese la razon del reporte..." minlength="2" maxlength="100"></textarea><br>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary ">
                                <span class="glyphicon glyphicon-send"></span> Enviar
                            </button>  
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span>Cancelar
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
            </div>
            
            
        </div>    
          
        
</body>
</html>