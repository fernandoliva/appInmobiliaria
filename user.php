<?php

//Importar conexion
require 'inc/config/database.php';
$db = conectarDB();

//Email y password
$email = "correo@correo.com";
$password = "123456";

//Hashear password
$passwordHash = password_hash($password, PASSWORD_BCRYPT); //El hash siempre constara de una extensión de 60 caracteres, por eso asignar en BBDD CHAR(60)

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${passwordHash}')";

//Insertar en la BBDD
mysqli_query($db, $query);