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
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <?php
                use \MongoDB\Driver\BulkWrite;
                use \MongoDB\Driver\Query;
                use \MongoDB\Driver\ReadPreference;
                $tipo = isset($_POST["tipo"])?$_POST["tipo"]:'';
                $client = new MongoDB\Driver\Manager(sprintf(
                    'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority'));
                if($id != '')
                {
                    $filter = ["_idCreador"=>$tipo];
                    $options = ['sort' =>['_id'=>-1],];
                    $query = new MongoDB\Driver\Query($filter,$options);
                    $rows = $client->executeQuery("proyecto.recetas", $query); // $mongo contains the connection object to MongoDB
                    foreach($rows as $r)
                    {
                        if($r->visible)
                        {                        
                            echo("<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>");
                            echo("<div class='panel panel-primary' >");    
                            echo("<div class='panel-heading'>".$r->titulo."</div>");
                            echo("<div class='panel-body' >");        
                            echo("<img src=".$r->imagen." class='thumbnail' alt='no tenia fotos de culo''>");
                            echo("<div class='panel-footer' >Tipo: ");
                            foreach($r->tipo as $tipo)
                            {       
                                echo(" ".$tipo." ");
                            }
                            echo("</div>");
                            echo("</div>");
                            echo("</div>");
                            echo("</div>");
                        }
                    }
                }
                
            ?>
        </div>
    </div>
</body>
</html>