<?php
    require 'inc/functions.php';
    includeTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en venta frente al bosque</h1>
        <p class="info-meta">Escrito el: <span>20/10/2021</span> por <span>Admin</span></p>
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpg">
            <img src="build/img/destacada.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>

        <div class="resumen-propiedad">
            <p>Nostrum sit laudantium obcaecati beatae, quibusdam praesentium recusandae vero laborum dolor quod quidem veniam dolores ad! Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus modi assumenda provident odio nisi, porro accusamus totam quae iure fuga ipsa consequuntur possimus aliquam doloremque exercitationem aperiam perferendis eius voluptate.</p>
            <p>Nostrum sit laudantium obcaecati beatae, quibusdam praesentium recusandae vero laborum dolor quod quidem veniam dolores ad! Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus modi assumenda provident odio nisi, porro accusamus totam quae iure fuga ipsa consequuntur possimus aliquam doloremque exercitationem aperiam perferendis eius voluptate.</p>
        </div>
    </main>
<?php includeTemplate('footer');?>