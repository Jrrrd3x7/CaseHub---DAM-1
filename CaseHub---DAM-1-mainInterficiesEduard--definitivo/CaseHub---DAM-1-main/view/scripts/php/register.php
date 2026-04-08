<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startAppSession(true);

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/create_account.html');
    exit();
}

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$email = trim($_POST['email'] ?? '');
$country = trim($_POST['pais'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$passwordConfirm = $_POST['password-confirm'] ?? '';

if ($password !== $passwordConfirm) {
    header('Location: ../html/create_account.html?error=' . urlencode('Las contrasenas no coinciden.'));
    exit();
}

$result = $userController->register($name, $surname, $email, $country, $phone, $password);

if ($result === true) {
    header('Location: profile.php');
    exit();
}

header('Location: ../html/create_account.html?error=' . urlencode($result));
exit();
