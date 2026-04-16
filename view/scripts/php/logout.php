<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startSession();

$userController = new UserController();
$userController->logout();

header('Location: ../html/login.php?success=' . urlencode('Sesion cerrada correctamente.'));
exit();
