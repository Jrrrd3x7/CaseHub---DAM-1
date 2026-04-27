<?php
require_once __DIR__ . '/../php/auth.php';

$userController = requireLogin();
$user = $userController->getCurrentUser();
$message = '';

//si el formulario fue enviado se almacenan la contraseña actual,la nueva y la confirmacion en una variable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'] ?? '';
    $new = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    //si la contraseña nueva no es igual a la confirmacion dara un mensaje de error, si es igual llamara al metodo updatePassword buscara al usuario por su id y le pasara los 
    if ($new !== $confirm) {
        $message = "Las contraseñas no coinciden.";
    } else {
        $result = $userController->updatePassword($user['id'], $current, $new);

        if ($result === true) {
            header('Location: account.php?password=updated');
            exit();
        }
        $message = $result;
    }
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
    <title>Cambiar contraseña</title>
</head>
<body>

<?php require_once __DIR__ . '/../php/partials/header.php'; ?>


<main class="form-page">
    <section class="form-card">
        <h2>Cambiar contraseña</h2>

        <?php if ($message): ?>
            <p class="form-message error"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>
                Contraseña actual
                <input type="password" name="current_password" required>
            </label>

            <label>
                Nueva contraseña
                <input type="password" name="new_password" required minlength="8">
            </label>

            <label>
                Confirmar nueva contraseña
                <input type="password" name="confirm_password" required minlength="8">
            </label><br><br>


            <button type="submit">Actualizar contraseña</button>
        </form>
<a href="../html/account.php"> Volver al perfil</a>

    </section>
</main>

<?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>
</html>
