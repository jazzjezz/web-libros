<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="es" class="hg-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/style/main.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/style/books.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Libros</title>
    </head>
    <body class="flex-container col hg-100">
        <!-- Menu principal de navegacion -->
        <?php require ('../assets/components/menu.php'); ?>

        <!-- Contenido principal de la pagina-->
        <main class="flex-container pd-4 flex-1 justify-content-center">
            <div id="books-container" class="flex-container pd-3 box-shadow align-self-center border-5 row app-container">
            </div>
        </main>
        
        <!-- footer -->
        <?php require ('../assets/components/footer.html'); ?>
        <script src="../assets/js/books_anim.js"></script>
    </body>
</html>