<fieldset>
    <legend>Información General</legend>
    <label for="nombre">nombre:</label>
    <input type="text" id="nombre" name="propiedad[nombre]" placeholder="Nombre de la propiedad" value="<?php echo s( $propiedad->nombre ); ?>">
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la propiedad" value="<?php echo s( $propiedad->precio ); ?>">
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
    <?php   if ($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="" class="imagen-tabla">
    <?php } ?>
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10"><?php echo s( $propiedad->descripcion ); ?></textarea>
</fieldset>
<fieldset>
    <legend>Información de la propiedad</legend>
    <label for="habitaciones">Habitaciones:</label>
    <input
        type="number"
        id="habitaciones"
        name="propiedad[habitaciones]"
        placeholder="Ej: 3"
        min="0"
        max="9"
        value="<?php echo s( $propiedad->habitaciones ); ?>">

    <label for="wc">Baños:</label>
    <input 
        type="number"
        id="wc"
        name="propiedad[wc]"
        placeholder="Ej: 1"
        min="0"
        max="9"
        value="<?php echo s( $propiedad->wc ); ?>">

    <label for="parking">Parking:</label>
    <input
        type="number"
        id="parking"
        name="propiedad[parking]"
        placeholder="Ej: 1"
        min="0"
        max="9"
        value="<?php echo s( $propiedad->parking ); ?>"> 
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <!--<select name="vendedorId">
        <option value="">--Seleccionar--</option>
        <?php //while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
            <option
            <?php //echo $vendedorId === s( $propiedad->vendedor['id'] ) ? 'selected' : ''; //Mantener seleccion previa del usuario ?>
                value="<?php //echo s( $propiedad->vendedor['id'] );?>">
            <?php //echo s( $propiedad->vendedor['nombre'] ) . " " . s( $propiedad->vendedor['apellidos'] ); ?>
            </option>
        <?php //endwhile;?>
    </select>-->
</fieldset>