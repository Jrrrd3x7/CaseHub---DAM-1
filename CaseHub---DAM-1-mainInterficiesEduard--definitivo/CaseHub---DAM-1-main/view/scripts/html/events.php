<?php
require_once __DIR__ . '/../php/auth.php';

$userController = appUserController();
$currentUser = $userController->getCurrentUser();
$isAdmin = ($currentUser['role'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>

<body>
<?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <section class="index_background"></section>

    <section>
        <h1>EVENTOS</h1>
    </section>

    <section>
        <h2>Eventos disponibles</h2>

        <div class="event-container">
            <a href="evento1.php" class="event-card">
                <img src="../../assets/fundas/sakura_case.png" alt="Funda premium CaseHUB">
                <h3>Fundas Premium 2026</h3>
                <p>Coleccion sostenible y elegante.</p>
                <span class="ver-mas">Ver mas</span>
            </a>
        </div>
    </section>

    <section>
        <a class="return form" href="searchEV.php">BUSCAR EVENTO</a>
    </section>

    <?php if ($isAdmin): ?>
        <section>
            <a class="return form" href="../php/createEV.php">CREAR EVENTO</a>
        </section>

        <section>
            <a class="return form" href="../php/editEV.php">EDITAR EVENTO</a>
        </section>

        <section>
            <a class="return form" href="../php/deleteEV.php">BORRAR EVENTO</a>
        </section>
    <?php endif; ?>

<?php require_once __DIR__ . '/../php/partials/footer.php'; ?>

</body>

</html>
