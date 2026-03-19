<?php
require_once "../controllers/UserController.php";

$userController = new UserController();

if (isset($_POST['login'])) {

    $resultado = $userController->login($_POST['email'], $_POST['password']);

    if ($resultado === true) {
        header("Location: ../index.php");
    } else {
        echo $resultado;
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button name="login">Login</button>
</form>

<a href="register.php">Registrarse</a>