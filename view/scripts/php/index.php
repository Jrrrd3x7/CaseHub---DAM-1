<?php
require_once "controllers/UserController.php";

$userController = new UserController();

if (!$userController->isLogged()) {
    header("Location: views/login.php");
    exit();
}
?>

<h1>Bienvenido <?php echo $_SESSION['nombre']; ?></h1>

<a href="logout.php">Cerrar sesión</a>