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

    <main class="event-page">
        <a href="events.php" class="back-button" aria-label="Volver a eventos">
            <i class="bi bi-arrow-left-circle"></i>
        </a>

        <article>
            <h2>Fundas Transparentes Pro</h2>

            <p>
                <strong>Fecha:</strong>
                <time datetime="2026-07-01">1 Julio 2026</time>
            </p>

            <section>
                <h3>Descripcion</h3>
                <p>Proteccion transparente con alta resistencia a impactos.</p>
            </section>

            <section>
                <h3>Video</h3>
                <video controls preload="metadata">
                    <source src="../../assets/videos/videoplayback.mp4" type="video/mp4">
                    Tu navegador no puede reproducir este video.
                </video>
            </section>

            <section>
                <h3>Audio</h3>
                <audio controls preload="metadata">
                    <source src="../../assets/videos/Sonido de la Naturaleza.mp3" type="audio/mp3">
                    Tu navegador no puede reproducir este audio.
                </audio>
            </section>
        </article>
    </main>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>


