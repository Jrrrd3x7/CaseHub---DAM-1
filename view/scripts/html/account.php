<?php
require_once __DIR__ . '/../php/auth.php';

$userController = requireLogin();
$user = $userController->getCurrentUser();

$userPhone = $user['phone'] !== '' ? $user['phone'] : 'No disponible';
$memberSince = $user['created_at'] ?? 'Activa en esta sesion';
$roleValue = $user['role'] ?? 'standard';
$userRole = 'Estandar';

if ($roleValue === 'admin') {
    $userRole = 'Administrador';
} elseif ($roleValue === 'premium') {
    $userRole = 'Premium';
}

$isAdmin = ($user['role'] ?? 'standard') === 'admin';
$userRole = $user['role'] ?? 'standard';
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

        <section class="form-card account-card">

                <i class="bi bi-person-badge">Mi cuenta</i> <br><br>

                <div class="account-summary">
                    <div class="account-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div>
                        <h2><?php echo htmlspecialchars(trim($user['name'] . ' ' . $user['surname'])); ?></h2>
                        <p><?php echo htmlspecialchars($userRole); ?> CaseHUB</p>
                    </div>
                </div>

                <div class="account-grid">
                    <div class="account-item">
                        <span class="account-label">Nombre</span>
                        <span><?php echo htmlspecialchars($user['name']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Apellidos</span>
                        <span><?php echo htmlspecialchars($user['surname']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Correo</span>
                        <span><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Pais</span>
                        <span><?php echo htmlspecialchars($user['country']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Telefono</span>
                        <span><?php echo htmlspecialchars($userPhone); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Estado de cuenta</span>
                        <span>Sesion iniciada</span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Tipo de usuario</span>
                        <span><?php echo htmlspecialchars($userRole); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">ID de usuario</span>
                        <span><?php echo htmlspecialchars((string) $user['id']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Miembro desde</span>
                        <span><?php echo htmlspecialchars($memberSince); ?></span>
                    </div>
                </div>

                <div class="account-actions">

                    <a class="button-link" href="editProfile.php">Editar datos personales</a>
                    <a class="button-link" href="../html/events.php">Ver eventos</a>
                    <?php if ($isAdmin): ?>
                        <a class="button-link" href="createEV.php">Crear evento</a>
                    <?php else: ?>
                        <a class="button-link" href="insert_card.php">Gestionar pago</a>
                    <?php endif; ?>
                    <a class="button-link" href="logout.php">Cerrar sesion</a>
                </div>

        </section>
    </main>

<?php require_once __DIR__ . '/../php/partials/footer.php'; ?>

</body>

</html>