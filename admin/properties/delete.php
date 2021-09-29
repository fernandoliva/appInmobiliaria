<?php
    require '../../inc/functions.php';        
    $auth = autenticado();

    if(!$auth){
        header('Location: /');
    }
    
    includeTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Eliminar</h1>
    </main>
<?php includeTemplate('footer');?>