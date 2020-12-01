<?php
    require_once("../vendor/autoload.php");
    require_once("../app/clases/google_auth.php");
    require_once("../app/clases/operaciones.php");
    require_once("../app/init.php");
?>

<!------------------------------------- SECTOR GOOGLE ICONS -------------------------------------->  
        <script src= "../scripts/barras.js"></script>      
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <link rel="stylesheet" href="../estilos/barras.css" type="text/css">
        
        <script src= "../scripts/servicios.js"></script>

        <nav class="navbar navbar-inverse">
            <div class="container">
                <form action="./mostrar recetas por titulo.php" method="GET" class="navbar-left" id="buscador">
                    <div id="mySidenav" class="sidenav"> <!--el ID y la CLASS del Sidebar-->
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <img id="imgPerfil" class='img-circle perfil' src=''>
                        <a id="primero"href="#"></a>
                        <a id="segundo" href="#"></a>
                        <a id="tercero"href="#"></a>
                        <a id="cuarto"href="#"></a>
                        <a id="quinto"href="#"></a>
                        <a id="sexto"href="#"></a>
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
                            <a href="../paginas/mostrar todas las recetas.php">
                            <span class="navbar-brand">
                                <i class="glyphicon glyphicon-queen"></i>
                                <strong> El Mandarín </strong>
                            </span></a>
                        </div>

                        <div class="input-group select-group form-group col-lg-6">
                            <select class="form-control input-group-addon" style="width:15%"id="selectBuscador">
                                <option value="1"> Titulo </option>
                                <option value="2"> Ingredientes </option>
                                <option value="3"> Categoria </option>
                            </select>
                            <div id="divBusqueda" >
                                <input type="text" class="form-control" name="busqueda" id="busqueda"placeholder="Buscar..."/>
                            </div> 
                            <div class="d-none" id="divCategoria">
                                <select  id="categoriaS2" class="form-control selectCategoria" name="categoria" style="width:85%; height:110%">
                                </select> 
                            </div>
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