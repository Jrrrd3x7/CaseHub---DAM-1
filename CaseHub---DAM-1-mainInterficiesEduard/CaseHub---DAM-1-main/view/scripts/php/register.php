<?php
require_once __DIR__ . '/../../../controller/UserController.php';

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/create_account.html');
    exit();
}

$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');
$email = trim($_POST['email'] ?? '');
$country = trim($_POST['pais'] ?? '');
$password = $_POST['password'] ?? '';
$passwordConfirm = $_POST['password-confirm'] ?? '';

if ($password !== $passwordConfirm) {
    header('Location: ../html/create_account.html?error=' . urlencode('Las contrasenas no coinciden.'));
    exit();
}

$result = $userController->register($name, $surname, $email, $country, $password);

if ($result === true) {
    header('Location: profile.php');
    exit();
}

header('Location: ../html/create_account.html?error=' . urlencode($result));
exit();
