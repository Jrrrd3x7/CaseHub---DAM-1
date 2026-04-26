<?php
require_once __DIR__ . '/../php/auth.php';

$userController = requireLogin();
$user = $userController->getCurrentUser();
$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $result = $userController->updateUser(
        $user['id'],
        $_POST['name'],
        $_POST['surname'],
        $_POST['email'],
        $_POST['country'],
        $_POST['phone'] ?? ''
    );

    if ($result === true) {
        $message = "Datos actualizados correctamente.";
        $user = $userController->getCurrentUser(); // refrescar datos
    } else {
        $message = $result;
    }
}



$userPhone = $user['phone'] !== '' ? $user['phone'] : 'No disponible';
$memberSince = $user['created_at'] ?? 'Activa en esta sesion';
$roleValue = $user['role'] ?? 'standard';
$isAdmin = $roleValue === 'admin';

$userRole = 'Estandar';
if ($roleValue === 'admin') {
    $userRole = 'Administrador';
} elseif ($roleValue === 'premium') {
    $userRole = 'Premium';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/formularios.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Mi Cuenta - CaseHUB</title>
</head>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <script src="../js/menus_desplegables.js"></script>

    <main class="form-page">
        <a class="back-link" href="../html/index.php">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Volver al inicio</span>
        </a>
        <h3>Editar datos personales</h3>

            <form method="POST" class="account-edit-form">
                <input type="hidden" name="update_profile" value="1">

                <label>
                    Nombre
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
                </label>

                <label>
                    Apellidos
                    <input type="text" name="surname" value="<?= htmlspecialchars($user['surname']) ?>" required>
                </label>

                <label>
                    Correo
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </label>

                <label>
                    País
                    <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>" required>
                </label>

                <label>
                    Teléfono
                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                </label>

                <button type="submit">Guardar cambios</button>
            </form>
            