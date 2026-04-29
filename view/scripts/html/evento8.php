<?php require_once __DIR__ . '/../php/auth.php'; appUserController(); ?>
<!DOCTYPE html>
<html lang="es">

<?php require_once __DIR__ . '/../php/partials/head.php'; ?>

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
        <a href="events.php" class="evento">← Volver a eventos</a>
    </section>

</article>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>


