<?php
require_once __DIR__ . '/../../../controller/UserController.php';

$userController = new UserController();
$userController->logout();

header('Location: ../html/login.html?success=' . urlencode('Sesion cerrada correctamente.'));
exit();
