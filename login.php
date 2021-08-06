<?php
    require 'inc/config/database.php';
    $db = conectarDB();
    $errores = [];

    //Autenticar el usuario y validación
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password){
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)){
            //Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '${email}'";
            $resultado = mysqli_query($db, $query);
            if($resultado -> num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                //Verificar password
                $auth = password_verify($password, $usuario['password']);
                if($auth){
                    //Iniciar sesion
                    session_start();

                    //Llenar el array de la sesion
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
                } else {
                    $errores[] = "El password es incorrecto";
                }
            }else{
                $errores[] = "El usuario no existe";
            }
        }
    }

    //Incluye el header
    require 'inc/functions.php';
    includeTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Iniciar Sesión</h1>
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>

        <form method="POST" class="formulario" novalidate>
            <fieldset>
                <legend>Email y Password</legend>
                <label for="email">E-mail</label>
                <input type="email" placeholder="Escribe tu correo electrónico" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Escribe tu contraseña" id="password" name="password" required>

                <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
            </fieldset>
        </form>
    </main>

<?php
    includeTemplate('footer');
?>