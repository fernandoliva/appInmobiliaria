<?php

session_start();

$_SESSION = []; //Se asigna valor null a array para destruir la sesion

header('Location: /');