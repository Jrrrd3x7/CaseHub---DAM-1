<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

function appUserController(): UserController
{
    static $userController = null;

    if ($userController instanceof UserController) {
        return $userController;
    }

    startSession();
    $userController = new UserController();

    return $userController;
}

function redirectTo(string $path, string $messageKey = '', string $message = ''): void
{
    $url = $path;

    if ($messageKey !== '' && $message !== '') {
        $separator = strpos($path, '?') === false ? '?' : '&';
        $url .= $separator . $messageKey . '=' . urlencode($message);
    }

    header('Location: ' . $url);
    exit();
}

function requireLogin(): UserController
{
    $userController = appUserController();

    if (!$userController->isLogged()) {
        redirectTo('../html/login.php', 'error', 'Debes iniciar sesion para acceder a esta pagina.');
    }

    return $userController;
}

function requireRole(string $role): UserController
{
    $userController = requireLogin();
    $currentUser = $userController->getCurrentUser();

    if (($currentUser['role'] ?? 'standard') !== $role) {
        redirectTo('account.php', 'error', 'No tienes permisos para acceder a esta seccion.');
    }

    return $userController;
}
