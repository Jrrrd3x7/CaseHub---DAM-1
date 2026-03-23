<?php
require_once "../controllers/UserController.php";

$userController = new UserController();

if (isset($_POST['register'])) {

    echo $userController->register(
        $_POST['nombre'],
        $_POST['email'],
        $_POST['password']
    );
}
?>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button name="register">Registrarse</button>
</form>

<a href="login.php">Ir a login</a>