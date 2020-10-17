<?php
    $client = new Mongo(
        'mongodb+srv://labo2020:labo2020@cluster0.wvxvt.mongodb.net/proyecto?retryWrites=true&w=majority');

    $db = $client->proyecto;
    $coleccion = $db->usuarios;
    $coleccion->insert(array("_id"=>"2","nombre"=>"test","googleID"=>"2","visible"=>FALSE));
?>