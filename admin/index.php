<?php

    require '../inc/app.php';        
    autenticado();

    use App\Propiedad;

    //Implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null; //Busca el valor, y si no existe aplica null, se usa para eliminar el error.

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if($id){
            //Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink('../imagenes/' . $propiedad['imagen']);

            //Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = ${id}";
            $resultado = mysqli_query($db, $query);

            if ($resultado){
                header('Location: /admin?resultado=3');
            }
        }
    }
    
    //Incluye un template
    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administrador Inmobiliaria Foliva</h1>
        <?php 
            if( intval($resultado) === 1){  //Intval convierte un string en un int
                ?>
                <p class="alerta exito">Anuncio creado correctamente.</p>
                <?php
            } else if( intval($resultado) === 2){  //Intval convierte un string en un int
                ?>
                <p class="alerta exito">Anuncio modificado correctamente.</p>
                <?php
            } else if( intval($resultado) === 3){  //Intval convierte un string en un int
                ?>
                <p class="alerta exito">Anuncio eliminado correctamente.</p>
                <?php
            }
        ?>

        <a href="/admin/properties/create.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!--Mostrar los resultados-->
            <?php foreach($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->nombre; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->precio; ?>€</td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/properties/update.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
<?php 

//Cerrar la conexion
mysqli_close($db);

includeTemplate('footer');

?>