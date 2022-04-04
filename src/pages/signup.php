<?php
    session_start();
    $errors = array();
    $name = $user = $pwd = $pwd2 = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $errors= array();
        $name = validate_request_data("name", "Nombre inválido");
        $user = validate_request_data("user", "Correo inválido");
        $pwd = validate_request_data("pwd", "Contraseña inválida");
        $pwd2 = validate_request_data("pwdconf", "Contraseña inválida");
        
        if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
           $errors[] = "Correo inválido";
        }

        if (strlen($name)< 1 || strlen($name) >40){
            $errors[] = "Nombre inválido";
        }

        if($pwd != $pwd2){
            $errors[] = "Las contraseñas no coinciden";
        }

        $pwd_num = preg_match('@[0-9]@', $pwd);
        $pwd_upper = preg_match('@[A-Z]@', $pwd);
        $pwd_lower = preg_match('@[a-z]@', $pwd);

        if(strlen($pwd)< 8 || strlen($pwd) > 32 || !$pwd_num || !$pwd_upper || !$pwd_lower){
            $errors[] = "La contraseña debe tener como mínimo 8 carácteres y máximo 32";
            $errors[] = "Debe contener al menos un carácter numerico, uno en mayúscula y uno en minúscula";
        }      

     
        if (empty($errors)){        
           require_once ('../assets/php/dbconnect.php');
           //buscar si el usuario ya existe.
           $stmt = $conn->prepare("SELECT COUNT(*) as UC FROM users WHERE user = ?");
           $stmt->bind_param("s", $user);
           $stmt->execute();
           $res=$stmt->get_result()->fetch_assoc();
           $stmt->close();
           if($res["UC"] > 0){
               $errors[] = "El usuario ya existe";
           }else {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users VALUES(NULL, ?, ?, ?)");
            $stmt->bind_param("sss", $user, $pwd, $name);
            try{
             $stmt->execute();
            } catch(mysqli_sql_exception $e){
                $errors[] = "Ocurrió un error inesperado.";
            } finally{
             $stmt->close();            
            }
            if(empty($errors)){
             $conn->close();
             header("Location: ../index.php");
             exit();
            }
           }
        }
     }

     function validate_request_data($param, $errMsg){
        global $errors;
         $data = test_input($_POST[$param]);
         if (empty($data)){
           $errors[] = $errMsg;
         }
         return $data;
     }

     function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="es" class="hg-100">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../assets/style/main.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Libros</title>
    </head>
    <body class="flex-container col hg-100">
        <!-- Menu principal de navegacion -->
        <?php require ('../assets/components/menu.php'); ?>

        <!-- Contenido principal de la pagina-->
        <main class="flex-container pd-4 flex-1 justify-content-center">
            <div class="flex-container pd-3 box-shadow align-self-center border-5 col app-container">
                <header><h2>Registrarse</h2></header>
                <form class="flex-container col" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label for="name" class="mg-1">Nombre</label>                        
                    <input type="text" id="name" name="name" class="border-5 mg-2 input" placeholder="paquito" required>
                    <label for="user" class="mg-1">Usuario (Correo electronico)</label>
                    <input type="email" id="user" name="user" class="border-5 mg-2 input" placeholder="paquito@outlook.com" required>

                    <div class="flex-container row" style="align-items: baseline;">
                        <label for="pwd" class="mg-1">Contraseña</label>
                        <input type="password" id="pwd" name="pwd" class="border-5 mg-2 input" minlength="8" required>
                        <label for="pwdconf" class="mg-1">Confirmar contraseña<label>
                        <input type="password" id="pwdconf" name="pwdconf" class="border-5 mg-2 input" minlength="8" required>
                    </div>
                    <spam style="font-size:.8em;">La contraseña debe tener como mínimo 8 carácteres</spam>                    
                    <spam style="font-size:.8em; color:red;"><?php echo implode("<br>", $errors) ?></spam>
                    <input type="submit" class="mg-3 primaryButton border-5 wd-30" value="Registrarse!">
                <form>
            </div>
        </main>        
        <!-- footer -->
        <?php require ('../assets/components/footer.html'); ?>
    </body>
</html>