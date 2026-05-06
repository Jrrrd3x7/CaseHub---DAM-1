<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startSession();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../html/login.php');
    exit();
}

$userController = new UserController();
$userId = $_SESSION['user_id'];

// Eliminar usuario
$userController->deleteUser($userId);

// Cerrar sesión
$_SESSION = [];
session_destroy();

// Redirigir
header('Location: ../html/login.php?deleted=1');
exit();