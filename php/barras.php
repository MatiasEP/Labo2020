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
    <title>Document</title>
</head>
<body>
    
    
    <nav class="navbar navbar-inverse">
        <div class="container">
          <form action="" class="navbar-left" id="buscador">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Clients</a>
                <a href="#">Contact</a>
              </div>
              <span style="font-size:30px;cursor:pointer" class="sidebtn navbar-brand" onclick="openNav()">&#9776;</span>
              
              <script>
              function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
              }
              
              function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
              }
              </script>
              
            <div class="navbar-header">
                <span class="navbar-brand"><i class="glyphicon glyphicon-queen"></i>El mandarin</span>
            </div>
            <div class="input-group select-group form-group col-lg-6">
                <select class="form-control input-group-addon ">
                    <option value="1">Titulo</option>
                    <option value="2">Tipo</option>
                    <option value="3">Ingredientes</option>
                </select> 
                <input type="text" class="form-control" placeholder="Buscar..."/>
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
                       
            </div>
        </form>
        
    </nav>
    <div class="main ">
        <h1 class="">Inicio</h1>
        <div class="row">
        <div class="card col-lg-4 " style="width: 18rem;">
            <img src="./pollo frito.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          <div class="card col-lg-4" style="width: 18rem;">
            <img src="./pollo frito.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          <div class="card col-lg-4" style="width: 18rem;">
            <img src="./pollo frito.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          <div class="card col-lg-4" style="width: 18rem;">
            <img src="./pollo frito.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
    </div>
    
</body>
</html>