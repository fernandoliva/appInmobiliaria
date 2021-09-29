<?php

    //Conexion a la BBDD
    //require __DIR__ . '/../config/database.php';
    $db = conectarDB();
    
    //Consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    //Resultado
    $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">
        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Anuncio" loading="lazy">
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['nombre']; ?></h3>
            <p><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio"><?php echo $propiedad['precio']; ?>€</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad['parking']; ?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton boton-amarillo-block">Ver propiedad</a>
        </div> <!--Contenido anuncio-->
    </div><!--Anuncio-->
    <?php endwhile; ?>
</div><!--Contenedor de anuncios-->
<?php
    //Cerrar la conexion
    mysqli_close($db);
?>