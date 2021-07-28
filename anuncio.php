<?php
    require 'inc/functions.php';
    includeTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpg">
            <img src="build/img/destacada.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">100.000€</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p>1</p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                    <p>3</p>
                </li>
            </ul>
            <p>Nostrum sit laudantium obcaecati beatae, quibusdam praesentium recusandae vero laborum dolor quod quidem veniam dolores ad! Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus modi assumenda provident odio nisi, porro accusamus totam quae iure fuga ipsa consequuntur possimus aliquam doloremque exercitationem aperiam perferendis eius voluptate.</p>
            <p>Nostrum sit laudantium obcaecati beatae, quibusdam praesentium recusandae vero laborum dolor quod quidem veniam dolores ad! Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus modi assumenda provident odio nisi, porro accusamus totam quae iure fuga ipsa consequuntur possimus aliquam doloremque exercitationem aperiam perferendis eius voluptate.</p>
        </div>
    </main>
<?php includeTemplate('footer');?>