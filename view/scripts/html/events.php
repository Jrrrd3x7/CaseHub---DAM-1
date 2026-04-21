<?php
require_once __DIR__ . '/../php/auth.php';

$isAdmin = false;
if (isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? '') === 'admin') {
    $isAdmin = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="events.css">
    
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>

<body>
<?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <section class="index_background"></section>

    <section>
        <h1>AGENDA EVENTOS 82026</h1>
    </section>

        <div class="event-container">
            <div class="event-card">
                <img src="../../assets/fundas/lyoppo.jpg" alt="Presentación del OPPO Reno 14 Series 5G en tienda">
                <h3>OPPO Reno 14 Series 5G</h3>
                <p>Consigue una firma de Lamine Yamal</p>
                <time datetime="2026-04-23">23 de abril 2026</time><br><br>
                <a href="evento1.html" class="evento">Ver evento</a>
            </div>



            <div class="event-card">
                <img src="../../assets/fundas/OTW.jpg" alt="mj">
                <h3>Disfruta de lo mejor de Michael Jackson</h3>
                <p>Sé el primero en escucharlo</p>
                <time datetime="2026-03-14">14 de Marzo 2026</time><br><br>
                <a href="evento2.html" class="evento">Ver evento</a>
            </div>

            <div class="event-card">
                <img src="../../assets/fundas/funda.jpg" alt="Funda ecológica">
                <h3>UAG Essential Armor</h3>
                <p>Lo mejor para proteger tu telefono</p>
                <time datetime="2026-03-15">15 de Marzo 2026</time><br><br>
                <a href="evento3.html" class="evento">Ver evento</a>
            </div>

            <div class="event-card">
                <img src="../../assets/fundas/sakura_case.png" alt="Funda lujo">
                <h3>Saca tu creatividad</h3>
                <p>¿Seras el ganador del sorteo?</p>
                <time datetime="2026-04-15">12,13,14 y 15 de Abril 2026</time><br><br>
                <a href="evento4.html" class="evento">Ver evento</a>

            </div>

            <div class="event-card">
                <img src="../../assets/fundas/Designer.png" alt="gaming">
                <h3>Participa en nuetro torneo gaming</h3>
                <p>Demuestra tu nivel</p>
                <time datetime="2026-05-14">14 y 15 de Mayo 2026</time><br><br>
                <a href="evento5.html" class="evento">Ver evento</a>
            </div>

            <div class="event-card">
                <img src="../../assets/fundas/setup.jpg" alt="setup">
                <h3>Monta tu setup perfecto</h3>
                <p>Para todo tipo de publico</p>
                <time datetime="2026-05-2">2 de mayo 2026</time><br><br>
                <a href="evento6.html" class="evento">Ver evento</a>
            </div>

            <div class="event-card">
                <img src="../../assets/fundas/ciberseguridad.jpg" alt="ciberseguridad">
                <h3>Taller de Seguridad Digital</h3>
                <p>Protege tu móvil y tus datos</p>
                <time datetime="2026-04-3">3 de abril 2026</time><br><br>
                <a href="evento7.html" class="evento">Ver evento</a>
            </div>

            <div class="event-card">
                <img src="../../assets/fundas/repa.png" alt="repa">
                <h3>Clínica del Móvil</h3>
                <p>Repara tu dispositivo movil</p>
                <time datetime="2026-04-26">26 de abril 2026</time><br><br>
                <a href="evento8.html" class="evento">Ver evento</a>
            </div>
        </div><br>
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
