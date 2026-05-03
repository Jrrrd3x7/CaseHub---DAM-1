<?php require_once __DIR__ . '/../php/auth.php';
appUserController(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Main -->
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <!-- CSS Desktop2 -->
    <link type="text/css" rel="stylesheet" href="../css/events.css">
    <link rel="stylesheet" href="../slick/slick-theme.css">
    <link rel="stylesheet" href="../slick/slick.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../slick/slick.min.js"></script>
    <script src="../js/casehubJS.js" defer></script>
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <!-- CSS Phones2 -->
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <!-- BS Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>

<body>
    <div id="overlay"></div>

    <div id="modal">
        <p>Funda añadida al carrito</p>
    </div>


    <div id="cookieBanner">
        <div class="cookie-content">
            <p>🍪 Este sitio utiliza cookies para mejorar la experiencia del usuario.</p>

            <div class="cookie-buttons">
                <button id="acceptCookies">Aceptar</button>
                <button id="rejectCookies">Rechazar</button>
            </div>
        </div>
    </div>


    <button id="loginBtn" style="display:none;">Login</button>
    <button id="showCookiesBtn" style="display:none;">Ver aviso cookies</button>

    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>
    <section class="index_background"></section>
    <section>
        <h1>CASE HUB</h1>
    </section>
    <div class="event-container">
        <div>
            <div class="product">
                <img src="../../assets/fundas iphone/funda amarilla/funda1.jfif" alt="">
                <div class="info">Funda amarilla - 15€</div>

            </div>
            <button id="openModal" class="cart-button">
                <i class="bi bi-cart-plus"></i>
                Añadir al carrito
            </button>
        </div>
    </div>
    <section class="slider-section">
        <h2>Eventos destacados</h2>

        <div class="sliderEvents">

            <div class="evento-card">
                <img src="../../assets/fundas/lyoppo.jpg" alt="">
                <h3>OPPO Reno 14 Series 5G</h3>
            </div>

            <div class="evento-card">
                <img src="../../assets/fundas/OTW.jpg" alt="">
                <h3>Disfruta de lo mejor de Michael Jackson</h3>
            </div>

            <div class="evento-card">
                <img src="../../assets/fundas/funda.jpg" alt="">
                <h3>UAG Essential Armor</h3>
            </div>
            <div class="evento-card">
                <img src="../../assets/fundas/Designer.png" alt="gaming">
                <h3>Participa en nuetro torneo gaming</h3>
            </div>

        </div>
    </section>

    <div>
        <section class="slider-section">
            <h2>Promotors</h2>

            <div class="sliderPromoters">

                <div class="promoter-card">
                    <h3>Fundas Antigolpes</h3>
                    <p>Proteccion reforzada para moviles con esquinas resistentes y materiales absorbentes.</p>
                    <span>iPhone · Samsung · Xiaomi</span>
                </div>

                <div class="promoter-card">
                    <h3>Fundas Transparentes</h3>
                    <p>Diseno fino y ligero para mostrar el color original del movil sin perder proteccion.</p>
                    <span>Silicona · Gel · MagSafe</span>
                </div>

                <div class="promoter-card">
                    <h3>Fundas Personalizadas</h3>
                    <p>Crea una funda unica con colores, iniciales, imagenes o estilos a tu gusto.</p>
                    <span>Fotos · Nombres · Disenos</span>
                </div>


            </div>
        </section>


    </div>
    <section>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab debitis pariatur repellendus,
        ut praesentium tempora optio dolore a quis provident odio id eos. Modi aperiam fuga error illo voluptat
        e recusandae assumenda cupiditate asperiores, perferendis nam enim corporis nisi possimus quae laboriosam
        ratione iusto molestiae fugiat, provident quis vero? Error perspiciatis aut corrupti minus nihil?
    </section>
    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>

</body>

</html>