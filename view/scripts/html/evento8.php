<?php require_once __DIR__ . '/../php/auth.php'; appUserController(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/events.css">
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

   <article>
    <section>
        <h1> Clínica del Móvil</h1>
        <p>Consejos de uso y mantenimiento para alargar la vida de tu móvily la optimización de batería y
            almacenamiento para mejorar su rendimiento.
        </p>
        <video controls style="max-width: 50%; height: auto;">
            <source src="../../assets/videos/reparacion.mp4" type="video/mp4">
        </video><br>
        <time datetime="2026-04-23">Fecha de evento: 26 de abril 2026</time><br><br>
        <a href="eventos.html" class="evento">← Volver a eventos</a>
    </section>

</article>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>


