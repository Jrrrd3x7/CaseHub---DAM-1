<?php require_once __DIR__ . '/../php/auth.php'; appUserController(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/evento.css">
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <section>
        <h1>Participa en nuetro torneo gaming</h1>
        <p>El ganador ganara un pase para STEAM y unos cascos gaming y un teclado y raton gaming</p>
        <img src="../../assets/fundas/Designer.png" alt="mj" style="width: 70%;"><br>
        <time datetime="2026-05-14">Dia 14 y 15 de Mayo 2026</time><br><br>
        <a href="eventos.php" class="evento">← Volver a eventos</a>
    </section>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>


