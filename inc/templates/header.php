<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    //var_dump($auth);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Foliva</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logoFinal.png" alt="Logotipo de Inmobiliaria Foliva" class="logoFinal">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <img src="/build/img/dark-mode.svg" alt="boton dark mode" class="dark-mode-boton">
                        <?php if($auth): ?>
                            <a href="/cerrar-sesion.php" class="boton boton-amarillo-sesion">Cerrar sesión</a>
                            <a href="/admin" class="boton boton-rojo-sesion">Administrador</a>
                        <?php else: ?>
                            <a href="/login.php" class="boton boton-amarillo-sesion">Iniciar sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <!--<h1>
                Venta de casas y pisos exclusivos de lujo
            </h1>-->
        </div>
    </header>