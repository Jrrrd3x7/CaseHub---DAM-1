<?php
require_once __DIR__ . '/../../../controller/UserController.php';

$userController = new UserController();

if (!$userController->isLogged()) {
    header('Location: ../html/login.html?error=' . urlencode('Debes iniciar sesion para acceder al perfil.'));
    exit();
}

$user = $userController->getCurrentUser();
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
    <title>Perfil - CaseHUB</title>
</head>

<body>
    <header>
        <nav class="nav-pc">
            <div>
                <ul>
                    <li><img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB"></li>
                    <li><a href="../html/index.html">TOP&nbsp;VENTAS</a></li>
                    <li><a href="#">SERVICIOS</a></li>
                    <li><a href="../html/events.html">EVENTOS</a></li>
                    <li><a href="#">PREMIUM</a></li>
                    <li><a href="../html/insert_card.html"><i class="bi bi-cart"></i></a></li>
                    <li id="menu-item1" class="menu-item1" style="position: relative;">
                        <a href="profile.php"><i class="bi bi-person"></i></a>
                        <ul id="submenu1" class="submenu1" style="position:absolute;top:40px;left:-100px;">
                            <li class="displayed-content"><a href="profile.php">PERFIL</a></li>
                            <li class="displayed-content"><a href="logout.php">CERRAR&nbsp;SESION</a></li>
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
                        <ul id="submenu2" class="submenu2" style="position:absolute;top:100px;left:-150px;">
                            <li class="displayed-content"><a href="../html/index.html">TOP&nbsp;VENTAS</a></li>
                            <li class="displayed-content"><a href="#">SERVICIOS</a></li>
                            <li class="displayed-content"><a href="../html/events.html">EVENTOS</a></li>
                            <li class="displayed-content"><a href="#">PREMIUM</a></li>
                            <li class="displayed-content"><a href="profile.php">PERFIL</a></li>
                            <li class="displayed-content"><a href="logout.php">CERRAR&nbsp;SESION</a></li>
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
        <section class="form-card">
            <fieldset>
                <legend><i class="bi bi-person-circle"></i> Perfil de usuario</legend>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                <p><strong>Apellidos:</strong> <?php echo htmlspecialchars($user['surname']); ?></p>
                <p><strong>Correo:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Pais:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
                <br>
                <a class="button-link" href="../html/events.html">Ir a eventos</a>
                <a class="button-link" href="logout.php">Cerrar sesion</a>
            </fieldset>
        </section>
    </main>

    <footer>
        <p>2025 CaseHUB</p>
    </footer>
</body>

</html>
