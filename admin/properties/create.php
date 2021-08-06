<?php

    require '../../inc/functions.php';        
    $auth = autenticado();

    if(!$auth){
        header('Location: /');
    }

    //BBDD
    require '../../inc/config/database.php';
    $db = conectarDB();

    //Consulta para obtener los vendedores
    $consulta ="SELECT * FROM  vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Array Errors
    $errores = [];

    $nombre = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $parking = '';
    $vendedorId = '';

    //Ejecutar el codigo despues de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //Validar valor metodo formulario POST a traves de los datos del servidor.

        //$numero = "1HOLA1";
        //$numero2 = 2;
        //Sanear código
        //$resultado = filter_var($numero, FILTER_SANITIZE_NUMBER_INT);
        //$resultado = filter_var($numero, FILTER_SANITIZE_STRING);
        //Validar código
        //$resultado = filter_var($numero2, FILTER_VALIDATE_INT);
        //var_dump($resultado);
        //exit;

        //echo "<pre>";
        //var_dump($_POST); //Mostrar los datos de la super variable global $_POST y acceder al valor ($_POST['nombre'])
        //echo "</pre>";

        //echo "<pre>";
        //var_dump($_FILES);  //Muestra datos especificos de los media subidos
        //echo "</pre>";

        //Validacion de variables via function mysqli real escape string, luego insercion

        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $parking = mysqli_real_escape_string($db, $_POST['parking']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //Asignar files hacia una variable

        $imagen = $_FILES['imagen'];

        //var_dump($imagen);
        //exit;

        //Validación form

        if(!$nombre){ //Si el nombre está vacio
            $errores[] = "Nombre obligatorio";
        }
        if(!$precio){
            $errores[] = "Precio obligatorio";
        }
        if(!$descripcion){
            $errores[] = "Descripción obligatoria";
        }
        if(!$habitaciones){
            $errores[] = "El número de habitaciones es obligatorio";
        }
        if(!$wc){
            $errores[] = "El número de baños es obligatorio";
        }
        if(!$parking){
            $errores[] = "El número de parkings es obligatorio";
        }
        if(!$vendedorId){
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen['name'] || $imagen['error']){
            $errores[] = "La imagen es obligatoria";
        }

        //Validad por tamaño ( 1MB max )

        $medida = 1000 * 1000;

        if(!$imagen['size'] > $medida){
            $errores[] = "La imagen tiene que tener un tamaño inferior a 100kb";
        }

        //echo "<pre>";
        //var_dump($errores);
        //echo "</pre>";

        //Validar que el array de errores esté vacio y inserta el código SQL
        if(empty($errores)){

            /*SUBIDA DE ARCHIVOS*/
            //Crear carpeta

            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            //Generar nombre unico para la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //var_dump($nombreImagen);

            //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            //Insertar datos en la BBDD
            $query = "INSERT INTO propiedades ( nombre, precio, imagen, descripcion, habitaciones, wc, parking, creado, vendedorId ) 
            VALUES ('$nombre', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$parking', '$creado', '$vendedorId')";

            //echo $query; Comprobar Query

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redireccionar al usuario una vez completada la operacion
                header('Location: /admin?resultado=1');
            }
        }
    }

    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <?php foreach($errores as $error): ?><!--Recorre el array de errores y muestra en la variable $error el valor asignado-->
        <div class="alerta error">
            <?php echo $error ?>
        </div>            
        <?php endforeach; ?>

        <form action="" class="formulario" method="POST" action="/admin/properties/create.php" enctype="multipart/form-data"> <!--Es necesario este enctype cuando se realiza una subida de archivos-->
            <fieldset>
                <legend>Información General</legend>
                <label for="nombre">nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la propiedad" value="<?php echo $nombre; ?>">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" value="<?php echo $imagen; ?>">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" cols="30" rows="10"><?php echo $descripcion; ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información de la propiedad</legend>
                <label for="habitaciones">Habitaciones:</label>
                <input
                    type="number"
                    id="habitaciones"
                    name="habitaciones"
                    placeholder="Ej: 3"
                    min="0"
                    max="9"
                    value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input 
                    type="number"
                    id="wc"
                    name="wc"
                    placeholder="Ej: 1"
                    min="0"
                    max="9"
                    value="<?php echo $wc; ?>">

                <label for="parking">Parking:</label>
                <input
                    type="number"
                    id="parking"
                    name="parking"
                    placeholder="Ej: 1"
                    min="0"
                    max="9"
                    value="<?php echo $parking; ?>"> 
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor">
                    <option value="">--Seleccionar--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option
                        <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; //Mantener seleccion previa del usuario ?>
                            value="<?php echo $vendedor['id'];?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellidos']; ?>
                        </option>
                    <?php endwhile;?>
                </select>
            </fieldset>
            <input type="submit" class="boton boton-verde" value="Crear propiedad">
        </form>
        <a href="/admin" class="boton boton-verde">Volver</a>
    </main>
<?php includeTemplate('footer');?>