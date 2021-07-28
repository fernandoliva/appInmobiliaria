<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', '', 'app_inmobiliaria');

    if(!$db){
        echo "Error, base de datos no conectada";
        exit;
    }

    return $db; //Retornar instancia de la conexion
}