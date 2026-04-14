<?php
require_once __DIR__ . '/auth.php';

header('Content-Type: application/json; charset=utf-8');

$userController = appUserController();
$user = $userController->getCurrentUser();
$role = $user['role'] ?? 'guest';

echo json_encode([
    'logged_in' => $userController->isLogged(),
    'role' => $role,
]);