<?php

    require '../../inc/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    autenticado();

    //BBDD
    //require '../../inc/config/database.php';
    $db = conectarDB();

    $propiedad = new Propiedad();

    //Consulta para obtener los vendedores
    $consulta ="SELECT * FROM  vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Array Errors
    $errores = Propiedad::getErrores();

    //Ejecutar el codigo despues de que el usuario envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){ //Validar valor metodo formulario POST a traves de los datos del servidor.
        
        $propiedad = new Propiedad($_POST['propiedad']);        
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        if($_FILES['imagen']['tmp_name']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);    
        }

        $errores = $propiedad->validar();

        //Resize a la imagen con intervention
        
        if(empty($errores)){

            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //Guardar en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            
            //Guardar en la BBDD
            $resultado = $propiedad->guardar();

            if($resultado){
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
            <?php include '../../inc/templates/formulario_propiedades.php'; ?>
            <input type="submit" class="boton boton-verde" value="Crear propiedad">
        </form>
        <a href="/admin" class="boton boton-verde">Volver</a>
    </main>
<?php includeTemplate('footer');?>