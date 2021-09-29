<?php

define('TEMPLATES_URL', __DIR__ . '/templates'); //__DIR__ nos trae la ruta completa del directorio, es una Variable Global.
define('FUNCTIONS_URL', __DIR__ . 'functions.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function includeTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function autenticado(){
    session_start();
    
    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escape HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}