<?php

    require '../../inc/functions.php';        
    $auth = autenticado();

    if(!$auth){
        header('Location: /');
    }

    //Validar la ID válida por URL
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id){
        header('Location: /admin');
    }
    
    //BBDD
    require '../../inc/config/database.php';
    $db = conectarDB();

    //Obtener los datos del array
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    //echo "<pre>";
    //var_dump($propiedad);
    //echo "</pre>";

    //Consulta para obtener los vendedores
    $consulta ="SELECT * FROM  vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Array Errors
    $errores = [];

    $nombre = $propiedad['nombre'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $parking = $propiedad['parking'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    //Ejecutar el codigo despues de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //Validar metodo formulario POST a traves de los datos del servidor.

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

        //if(!$imagen['name'] || $imagen['error']){
        //    $errores[] = "La imagen es obligatoria";
        //}

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

            $nombreImagen = '';

            if($imagen['name']){
                //Eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']); //Funcion para eliminar archivos

                //Generar nombre unico para la imagen
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }

            //Update data en la BBDD
            $query = "UPDATE propiedades SET nombre = '${nombre}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', 
            habitaciones = ${habitaciones}, wc = ${wc}, parking = ${parking}, vendedorId = ${vendedorId} WHERE id = ${id}";

            //echo $query; Comprobar Query

            $resultado = mysqli_query($db, $query);

            if($resultado){
                //Redireccionar al usuario una vez completada la operacion
                header('Location: /admin?resultado=2');
            }
        }
    }


    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <?php foreach($errores as $error): ?><!--Recorre el array de errores y muestra en la variable $error el valor asignado-->
        <div class="alerta error">
            <?php echo $error ?>
        </div>            
        <?php endforeach; ?>

        <form action="" class="formulario" method="POST" enctype="multipart/form-data"> <!--Es necesario este enctype cuando se realiza una subida de archivos-->
            <fieldset>
                <legend>Información General</legend>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la propiedad" value="<?php echo $nombre; ?>">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio; ?>">
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" value="<?php echo $imagen; ?>">
                <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="preview">
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
            <input type="submit" class="boton boton-verde" value="Actualizar propiedad">
        </form>
        <a href="/admin" class="boton boton-verde">Volver</a>
    </main>
<?php includeTemplate('footer');?>