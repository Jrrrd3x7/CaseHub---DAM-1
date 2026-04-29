<?php
require_once __DIR__ . '/../php/auth.php';

$userController = requireLogin();
?>

<!DOCTYPE html>
<html lang="es">

<?php require_once __DIR__ . '/../php/partials/head.php'; ?>

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