<?php
require_once __DIR__ . '/../php/auth.php';

$userController = requireLogin();
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
    <link rel="stylesheet" href="../css/formularios.css">
    <title>Darse de baja</title>
</head>

<body>

    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <main class="form-page">
        <section class="form-card">
            <h2>Eliminar cuenta</h2>
            <p>Esta acción es irreversible. ¿Estás seguro?</p>

            <form method="POST" action="../php/deleteUser.php">
                <button type="submit" class="danger">
                    Sí, eliminar mi cuenta
                </button>
                <a href="account.php">Cancelar</a>
            </form>
        </section>
    </main>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>