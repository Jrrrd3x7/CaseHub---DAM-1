<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startAppSession();

$userController = new UserController();

if (!$userController->isLogged()) {
    header('Location: ../html/create_account.html?error=' . urlencode('Debes crear una cuenta o iniciar sesion para acceder al perfil.'));
    exit();
}

header('Location: account.php');
exit();
