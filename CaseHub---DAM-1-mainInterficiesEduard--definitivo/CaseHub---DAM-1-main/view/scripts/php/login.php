<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startSession(isset($_POST['remember']));

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../html/login.php');
    exit();
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$result = $userController->login($email, $password);

if ($result === true) {
    header('Location: profile.php');
    exit();
}

header('Location: ../html/login.php?error=' . urlencode($result));
exit();
