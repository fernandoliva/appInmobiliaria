<?php
    require 'inc/app.php';
    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h2>Casas y Pisos en venta</h2>
        <?php
            $limite = 10;
            include 'inc/templates/anuncios.php';
        ?>
    </main>
<?php includeTemplate('footer');?>