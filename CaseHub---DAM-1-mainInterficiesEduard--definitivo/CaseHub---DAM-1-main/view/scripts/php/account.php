<?php
require_once __DIR__ . '/../../../config/session.php';
require_once __DIR__ . '/../../../controller/UserController.php';

startAppSession();

$userController = new UserController();

if (!$userController->isLogged()) {
    header('Location: ../html/create_account.html?error=' . urlencode('Debes crear una cuenta o iniciar sesion para acceder al perfil.'));
    exit();
}

$user = $userController->getCurrentUser();
$userPhone = $user['phone'] !== '' ? $user['phone'] : 'No disponible';
$memberSince = $_SESSION['user_created_at'] ?? 'Activa en esta sesion';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/formularios.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Mi Cuenta - CaseHUB</title>
</head>

<body>
    <header>
        <nav class="nav-pc">
            <div>
                <ul>
                    <li><img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB"></li>
                    <li><a href="../html/index.html">TOP VENTAS</a></li>
                    <li><a href="#">SERVICIOS</a></li>
                    <li><a href="../html/events.html">EVENTOS</a></li>
                    <li><a href="#">PREMIUM</a></li>
                    <li><a href="../html/insert_card.html"><i class="bi bi-cart"></i></a></li>
                    <li id="menu-item1" class="menu-item1" style="position: relative;">
                        <a href="#" aria-label="Abrir menu de usuario"><i class="bi bi-person"></i></a>
                        <ul id="submenu1" class="submenu1" style="position:absolute;top:40px;left:-120px;">
                            <li class="displayed-content"><a href="account.php">PERFIL</a></li>
                            <li class="displayed-content"><a href="logout.php">CERRAR SESION</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="nav-phone">
            <div>
                <ul>
                    <li id="menu-item2" class="menu-item2" style="position: relative;">
                        <a href="#"><i class="bi bi-list"></i></a>
                        <ul id="submenu2" class="submenu2" style="position:absolute;top:100px;left:-160px;">
                            <li class="displayed-content"><a href="../html/index.html">TOP VENTAS</a></li>
                            <li class="displayed-content"><a href="#">SERVICIOS</a></li>
                            <li class="displayed-content"><a href="../html/events.html">EVENTOS</a></li>
                            <li class="displayed-content"><a href="#">PREMIUM</a></li>
                            <li class="displayed-content"><a href="account.php">PERFIL</a></li>
                            <li class="displayed-content"><a href="logout.php">CERRAR SESION</a></li>
                        </ul>
                        <img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB">
                    </li>
                    <li><a href="../html/insert_card.html"><i class="bi bi-cart"></i></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <script src="../js/menus_desplegables.js"></script>

    <main class="form-page">
        <a class="back-link" href="../html/index.html">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Volver al inicio</span>
        </a>

        <section class="form-card account-card">
            <fieldset>
                <legend><i class="bi bi-person-badge"></i> Mi cuenta</legend>

                <div class="account-summary">
                    <div class="account-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div>
                        <h2><?php echo htmlspecialchars(trim($user['name'] . ' ' . $user['surname'])); ?></h2>
                        <p>Cliente CaseHUB</p>
                    </div>
                </div>

                <div class="account-grid">
                    <div class="account-item">
                        <span class="account-label">Nombre</span>
                        <span><?php echo htmlspecialchars($user['name']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Apellidos</span>
                        <span><?php echo htmlspecialchars($user['surname']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Correo</span>
                        <span><?php echo htmlspecialchars($user['email']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Pais</span>
                        <span><?php echo htmlspecialchars($user['country']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Telefono</span>
                        <span><?php echo htmlspecialchars($userPhone); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Estado de cuenta</span>
                        <span>Sesion iniciada</span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">ID de usuario</span>
                        <span><?php echo htmlspecialchars((string) $user['id']); ?></span>
                    </div>
                    <div class="account-item">
                        <span class="account-label">Miembro desde</span>
                        <span><?php echo htmlspecialchars($memberSince); ?></span>
                    </div>
                </div>

                <div class="account-actions">
                    <a class="button-link" href="../html/events.html">Ver eventos</a>
                    <a class="button-link" href="logout.php">Cerrar sesion</a>
                </div>
            </fieldset>
        </section>
    </main>

    <footer>
        <div class="footer-sitemap">
            <h3>Mapa Web</h3>
            <ul class="footer-links">
                <li><a href="../html/index.html">Inicio</a></li>
                <li><a href="../html/events.html">Eventos</a></li>
                <li><a href="../html/evento1.html">Evento actual</a></li>
                <li><a href="../html/createEV.html">Crear evento</a></li>
                <li><a href="../html/login.html">Iniciar sesion</a></li>
                <li><a href="account.php">Perfil</a></li>
            </ul>
            <p>2025 CaseHUB</p>
        </div>
    </footer>
</body>

</html>
