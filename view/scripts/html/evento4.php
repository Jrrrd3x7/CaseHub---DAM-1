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
        <h1>Saca tu creatividad</h1>
        <p>Dirigete a cualquiera de nuestras tiendas y saca tu creatividad personalizando una funda para tu
            dispositivo movil y entra en el sorteo de unos auriculares inhalambricos.</p>
        <img src="../../assets/fundas/sakura_case.png" alt="sc" style="width: 50%;"><br>
        <time datetime="2026-04-15">Disfruta del evento los dias 12,13,14 y 15 de Abril 2026</time><br><br>
        <a href="eventos.html" class="evento">← Volver a eventos</a>
    </section>

</article>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>


