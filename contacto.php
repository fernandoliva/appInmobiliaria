<?php
    require 'inc/functions.php';
    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
        </picture>

        <h2>Rellena el formulario de contacto</h2>

        <form action="" class="formulario">
            <fieldset>
                <legend>Información Personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Escribe tu nombre" id="nombre">
                <label for="email">E-mail</label>
                <input type="email" placeholder="Escribe tu correo electrónico" id="email">
                <label for="tel">Email</label>
                <input type="tel" placeholder="Escribe tu teléfono" id="tel">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" placeholder="Escribe tu mensaje"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="opciones">Tipo:</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccionar --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>
                <label for="presupuesto">Presupuesto</label>
                <input type="number" placeholder="Tu presupuesto" id="presupuesto">
            </fieldset>
            <fieldset>
                <legend>Contacto</legend>
                <p>¿Como quieres que te contactemos?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="Telefono" id="contactar-telefono">
                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="E-mail" id="contactar-email">
                </div>
                <p>Elige tu Fecha/Hora</p>
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha">
                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>
<?php includeTemplate('footer');?>