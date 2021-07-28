<?php
    require 'inc/functions.php';
    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpg">
                    <img src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <blockquote>25 años de experiencia</blockquote>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio tempora nam dolorum repellendus sed! Cumque enim eveniet non, libero animi quaerat dolorum nulla repellat ex quae! Nam veritatis unde quod. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia adipisci a labore esse quaerat molestiae eligendi sint doloribus vitae ipsa doloremque minima, libero natus provident maiores ut beatae ab aliquam. Lorem Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure cupiditate eligendi voluptate hic molestias,</p>
                <p>Nostrum sit laudantium obcaecati beatae, quibusdam praesentium recusandae vero laborum dolor quod quidem veniam dolores ad! Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus modi assumenda provident odio nisi, porro accusamus totam quae iure fuga ipsa consequuntur possimus aliquam doloremque exercitationem aperiam perferendis eius voluptate.</p>
            </div>
        </div>
    </main>
    <section class="contenedor seccion">
        <h1>Algo más...</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet, consectetur </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet, consectetur </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur </p>
            </div>
        </div>
    </section>
<?php includeTemplate('footer');?>