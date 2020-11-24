
<!------------------------------------- SECTOR GOOGLE ICONS -------------------------------------->        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../estilos/barras.css" type="text/css">
        <?php include "../php/get_categorias.php" ?>
        <script src= "../scripts/categorias.js"></script>
        <script src= "../scripts/servicios.js"></script>

        <nav class="navbar navbar-inverse">
            <div class="container">
                <form action="./mostrar recetas por titulo.php" method="post" class="navbar-left" id="buscador">
                    <div id="mySidenav" class="sidenav"> <!--el ID y la CLASS del Sidebar-->
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <a id="sesionData"href="#"></a>
                        <a id ="micuenta" href="#"></a>
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
                            <select class="form-control input-group-addon sel">
                                <option value="1"> Titulo </option>
                                <option value="2"> Ingredientes </option>
                            </select> 
                            <input type="text" class="form-control busquedas" name="busqueda" placeholder="Buscar..."/>
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