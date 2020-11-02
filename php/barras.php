<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!------------------------------------- SECTOR GOOGLE ICONS -------------------------------------->        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">      
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../estilos/barras.css" type="text/css">
        <title>Document</title>
    </head>
    <body>


        <nav class="navbar navbar-inverse">
            <div class="container">
                <form action="" class="navbar-left" id="buscador">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a href="#">Pastas</a>
                        <a href="#">Carnes</a>
                        <a href="#">Salsas</a>
                        <a href="#">Huevos &amp; Lacteos</a>
                        <a href="#">Panificados</a>
                        <a href="#">Coctéles &amp; Bebidas</a>
                        <a href="#">Aperitivos</a>
                        <a href="#">Ensaladas</a>
                        <a href="#">Postres</a>
                        <a href="#">Sopas &amp; Cremas</a>
                        <a href="#">Verduras</a>
                        <a href="#">Legumbres</a>
                    </div>
                    <span style="font-size:30px;cursor:pointer" class="sidebtn navbar-brand" onclick="openNav()">&#9776;</span>

                    <script>
                        function openNav() 
                        {
                            document.getElementById("mySidenav").style.width = "250px";
                        }

                        function closeNav() 
                        {
                            document.getElementById("mySidenav").style.width = "0";
                        }
                    </script>
                    
                    <div class="cabecera">
                        <div class="navbar-header">
                            <span class="navbar-brand">
                                <i class="glyphicon glyphicon-queen"></i>
                                <strong> El Mandarín </strong>
                            </span>
                        </div>

                        <div class="input-group select-group form-group col-lg-6">
                            <select class="form-control input-group-addon ">
                                <option value="1"> Titulo </option>
                                <option value="3"> Ingredientes </option>
                            </select> 
                            <input type="text" class="form-control" placeholder="Buscar..."/>
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>                        
                    </div>
                    
                    
                    
                </form>
            </div>
        </nav>
        
        
    </body>
</html>