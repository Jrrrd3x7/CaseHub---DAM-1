<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startSession(true);

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/create_account.php');
    exit();
}

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$email = trim($_POST['email'] ?? '');
$country = trim($_POST['pais'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$passwordConfirm = $_POST['password-confirm'] ?? '';
$role = $_POST['role'] ?? 'standard';

if ($password !== $passwordConfirm) {
    header('Location: ../html/create_account.php?error=' . urlencode('Las contrasenas no coinciden.'));
    exit();
}

$result = $userController->register($name, $surname, $email, $country, $phone, $password, $role);

if ($result === true) {
    header('Location: ../html/account.php');
    exit();
}

header('Location: ../html/create_account.php?error=' . urlencode($result));
exit();
