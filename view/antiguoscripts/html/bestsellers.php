<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Main -->
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <!-- CSS Desktop2 -->
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <!-- CSS Phones2 -->
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <!-- CSS Formularios -->
    <link type="text/css" rel="stylesheet" href="../css/formularios.css">
    <!-- BS Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>
<body>
<?php require_once __DIR__ . '/../php/partials/header.php'; ?>
 <section class="index_background"></section>

    <section>
        <h1>LO MAS VENDIDO</h1>

        <div class="event-container">
            <div href="" class="event-card">
                <img src="../../assets/fundas/sakura_case.png" alt="Funda premium CaseHUB">
                <h3>Fundas Premium 2026</h3>
                <p>Coleccion sostenible y elegante.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/black_case.png" alt="Funda gaming">
                <h3>Fundas Gaming</h3>
                <p>Proteccion extrema para gamers.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/patriot_case.png" alt="Funda ecologica">
                <h3>Fundas Eco</h3>
                <p>Materiales reciclados.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/mi_amor.png" alt="Funda luxury">
                <h3>Edicion Luxury</h3>
                <p>Diseno exclusivo.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/shark_case.png" alt="Test resistencia">
                <h3>Test de Resistencia</h3>
                <p>Pruebas extremas.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/sakura_case.png" alt="Workshop diseno">
                <h3>Workshop Diseno</h3>
                <p>Crea tu funda.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/mi_amor.png" alt="Colaboracion influencer">
                <h3>Colaboracion Influencer</h3>
                <p>Nueva coleccion exclusiva.</p>
                <span class="ver-mas">Ver mas</span>
            </div>

            <div href="" class="event-card">
                <img src="../../assets/fundas/black_case.png" alt="Feria tecnologica">
                <h3>Feria Tecnologica</h3>
                <p>Presentacion global.</p>
                <span class="ver-mas">Ver mas</span>
            </div>
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