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

    <article>
    <section>
        <h1>Taller de Seguridad Digital</h1>
        <p>Cómo proteger tu móvil y tus datos aprenderas a crear copias de seguridad y evitar estafas online y cómo
            evitarlas</p>
        <img src="../../assets/fundas/ciberseguridad.jpg" alt="mj" style="width: 70%;"><br>
        <audio controls>
            <source src="../../assets/audio/asc.mp3" type="audio/mpeg">
        </audio><br>
        <time datetime="2026-04-03">Fecha de evento: 3 de abril 2026</time><br><br>
        <a href="eventos.php" class="evento">← Volver a eventos</a>
    </section>

</article>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>

