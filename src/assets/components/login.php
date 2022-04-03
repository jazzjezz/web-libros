<?php 
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
   header("Location: /pages/libros.php");
   exit();
}
$user = $pwd = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
   $errors= array();
   $user = validate_request_data("user", "Correo inválido");
   $pwd = validate_request_data("pwd", "Contraseña inválida");
   
   if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Correo inválido";
   }

   if (empty($errors)){
      require_once ('assets/php/dbconnect.php');
      $stmt = $conn->prepare("SELECT ID, PASSWORD, NAME FROM users WHERE USER = ?");
      $stmt->bind_param("s", $user);
      $stmt->execute();
      $res = $stmt->get_result();
      $res = $res->fetch_assoc();
      $stmt->close();
      if(password_verify($pwd, $res["PASSWORD"] ?? "")){
         $_SESSION['user_name'] = $user;
         $_SESSION['name'] = $res["NAME"];
         $_SESSION['id'] = $res["ID"];
         $conn->close();
         header("Location: /pages/libros.php");
         exit();
      } else {
         $errors[] = "Usuario o contraseña incorrectos.";
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

<div class="flex-container pd-3 box-shadow align-self-center border-5 col app-container">
 <header><h2>Iniciar Sesión</h2></header>
 <form class="flex-container col" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="user" class="mg-1">Usuario</label>
    <input type="email" id="user" name="user" class="border-5 mg-2 input" placeholder="example@outlook.com" required>
    <label for="pwd" class="mg-1">Contraseña</label>
    <input type="password" id="pwd" name="pwd" class="border-5 mg-2 input" minlength=“6>
    <spam style="font-size:.8em">¿No recuerdas tu contraseña? <a href="#">aquí puedes recuperarla</a></spam>
    <spam style="font-size:.8em"><a href="#">¡Registrate!</a></spam>
    <spam style="font-size:.8em; color:red;"><?php echo implode("<br>", $errors) ?></spam>
    <input type="submit" class="mg-3 primaryButton border-5 wd-30" value="Iniciar">
 </form>
</div>