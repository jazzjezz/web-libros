<nav class="flex-container bg-white flex-wrap row navShadow nav">
    <div class="flex-container menuItem row flex-1">
        <a href="/index.php" class="align-items-center"><span class="material-icons">home</span>Inicio</a>
    </div>
    <div class="flex-container menuItem row">
        <a href="/pages/books.php">Productos</a>                
    </div>
    <div class="flex-container menuItem row">
        <a href="#">Acerca de</a>                
    </div>
    <?php         
        if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
            echo '<div class="flex-container menuItem row" disabled><a href="#">' . $_SESSION['user_name'] . '</a></div>';
            echo '<div class="flex-container menuItem row"><a href="/assets/php/logout.php">Cerrar Sesión</a></div>';
        } else {
            echo '<div class="flex-container menuItem row"><a href="/index.php">Iniciar Sesión</a></div>';
            echo '<div class="flex-container menuItem row"><a href="/pages/signup.php">Registrarse</a></div>';
        }
    ?>
    <div class="flex-container menuItem row">
        <a href="#"><span class="material-icons">search</span></a>
    </div>
</nav>