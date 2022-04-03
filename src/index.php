<?php 
    @ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="es" class="hg-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./assets/style/main.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Libros</title>
    </head>
    <body class="flex-container col hg-100">
        <!-- Menu principal de navegacion -->
        <?php require ('./assets/components/menu.php'); ?>

        <!-- Contenido principal de la pagina-->
        <main class="flex-container pd-4 flex-1 justify-content-center">
        <?php require ('./assets/components/login.php'); ?>
        </main>
        
        <!-- footer -->
        <?php require ('./assets/components/footer.html'); ?>
    </body>
</html>