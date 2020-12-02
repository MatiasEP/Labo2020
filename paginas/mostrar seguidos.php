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
    <script src="../scripts/mostrar seguidos.js" async></script>
    <?php 

            include '../php/barras.php';

            $googleClient = new Google_Client();
            $auth = new GoogleAuth($googleClient);  

            $ctrl = new Operaciones();
            if(!$ctrl->isLoggedIn()){
                echo "<script>window.location = 'http://localhost/Labo2020/paginas/mostrar todas las recetas.php';        </script>";
            }

            if(!($ctrl->checkRole("ver seguidos"))){
                echo "<script>window.location = 'http://localhost/Labo2020/paginas/mostrar todas las recetas.php';        </script>";

            }?>
    <title>Inicio</title>
</head>
<body>
    <div class="container" >
        <div class="row" id="main">

        </div>
    </div>

    
</body>
</html>