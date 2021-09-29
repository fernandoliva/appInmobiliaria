<?php

use App\Propiedad;

require '../../inc/app.php';
    autenticado();

    //Validar la ID válida por URL
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id){
        header('Location: /admin');
    }

    //Obtener los datos del objeto
    $propiedad = Propiedad::find($id);

    //Consulta para obtener los vendedores
    //$consulta ="SELECT * FROM  vendedores";
    //$resultado = mysqli_query($db, $consulta);

    //Array Errors
    $errores = [];

    //Ejecutar el codigo despues de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

        $args = $_POST['propiedad'];
        $propiedad->sincronizar($args);
        debug($propiedad);

        $imagen = $_FILES['propiedad']['imagen'];

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
            <?php include '../../inc/templates/formulario_propiedades.php'; ?>
            <input type="submit" class="boton boton-verde" value="Actualizar propiedad">
        </form>
        <a href="/admin" class="boton boton-verde">Volver</a>
    </main>
<?php includeTemplate('footer');?>