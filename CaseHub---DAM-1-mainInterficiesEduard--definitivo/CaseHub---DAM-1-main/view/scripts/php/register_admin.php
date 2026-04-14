<?php
require_once __DIR__ . '/auth.php';

startSession();

$error = $_GET['error'] ?? '';
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
    <title>Registro administrador - CaseHUB</title>
</head>

<body>
    <header>
        <nav class="nav-pc">
            <div>
                <ul>
                    <li><img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB"></li>
                    <li><a href="../html/index.php">TOP VENTAS</a></li>
                    <li><a href="#">SERVICIOS</a></li>
                    <li><a href="../html/events.php">EVENTOS</a></li>
                    <li><a href="#">PREMIUM</a></li>
                    <li><a href="insert_card.php"><i class="bi bi-cart"></i><span class="sr-only">Carrito</span></a></li>
                    <li id="menu-item1" class="menu-item1" style="position: relative;">
                        <a href="#" aria-label="Abrir menu de usuario"><i class="bi bi-person"></i></a>
                        <ul id="submenu1" class="submenu1" style="position:absolute;top:40px;left:-100px;">
                            <li class="displayed-content"><a href="../html/login.php">INICIAR SESION</a></li>
                            <li class="displayed-content"><a href="../html/create_account.php">REGISTRAR ESTANDAR</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <nav class="nav-phone">
            <div>
                <ul>
                    <li id="menu-item2" class="menu-item2" style="position: relative;">
                        <a href="#" aria-label="Abrir menu de navegacion"><i class="bi bi-list"></i></a>
                        <ul id="submenu2" class="submenu2" style="position:absolute;top:100px;left:-150px;">
                            <li class="displayed-content"><a href="../html/index.php">TOP VENTAS</a></li>
                            <li class="displayed-content"><a href="#">SERVICIOS</a></li>
                            <li class="displayed-content"><a href="../html/events.php">EVENTOS</a></li>
                            <li class="displayed-content"><a href="#">PREMIUM</a></li>
                            <li class="displayed-content"><a href="../html/login.php">INICIAR SESION</a></li>
                            <li class="displayed-content"><a href="../html/create_account.php">REGISTRAR ESTANDAR</a></li>
                        </ul>
                        <img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB">
                    </li>
                    <li><a href="insert_card.php"><i class="bi bi-cart"></i><span class="sr-only">Carrito</span></a></li>
                </ul>
            </div>
        </nav>
    </header>

    <script src="../js/menus_desplegables.js"></script>

    <main class="form-page">
        <a class="back-link" href="../html/index.php">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Volver al inicio</span>
        </a>

        <section class="form-card" aria-labelledby="account-title">
            <form id="accountForm" action="register.php" method="post" enctype="multipart/form-data" autocomplete="on">
                <fieldset>
                    <legend id="account-title"><i class="bi bi-shield-lock"></i> Registro administrador</legend>
                    <p class="form-intro">Formulario exclusivo para cuentas admin. Incluye la imagen de perfil para identificar al responsable.</p>
                    <input type="hidden" name="role" value="admin">

                    <?php if ($error !== ''): ?>
                        <p class="helper-text" style="color:#b42318;"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <div class="form-grid">
                        <div class="form-row">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" required minlength="2" maxlength="40" placeholder="Nombre">
                        </div>

                        <div class="form-row">
                            <label for="surname">Apellido</label>
                            <input type="text" id="surname" name="surname" required minlength="2" maxlength="60" placeholder="Apellido">
                        </div>

                        <div class="form-row">
                            <label for="email">Correo electronico</label>
                            <input type="email" id="email" name="email" required maxlength="80" placeholder="admin@email.com">
                        </div>

                        <div class="form-row">
                            <label for="phone">Telefono</label>
                            <input type="tel" id="phone" name="phone" required minlength="9" maxlength="20" placeholder="+34 612345678" pattern="^[0-9+ ]{9,20}$">
                        </div>

                        <div class="form-row">
                            <label for="password">Contrasena</label>
                            <input type="password" id="password" name="password" required minlength="8" maxlength="50">
                        </div>

                        <div class="form-row">
                            <label for="password-confirm">Confirmar contrasena</label>
                            <input type="password" id="password-confirm" name="password-confirm" required minlength="8" maxlength="50">
                        </div>

                        <div class="form-row">
                            <label for="pais">Pais</label>
                            <select id="pais" name="pais" required>
                                <option value="">-- Selecciona un pais --</option>
                                <option value="RU">Rusia</option>
                                <option value="ES">Espana</option>
                                <option value="MX">Mexico</option>
                                <option value="AR">Argentina</option>
                                <option value="CO">Colombia</option>
                                <option value="CL">Chile</option>
                                <option value="PE">Peru</option>
                                <option value="US">Estados Unidos</option>
                                <option value="CA">Canada</option>
                                <option value="FR">Francia</option>
                                <option value="DE">Alemania</option>
                                <option value="IT">Italia</option>
                                <option value="PT">Portugal</option>
                                <option value="UK">Reino Unido</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="profile-image">Imagen de perfil</label>
                            <input type="file" id="profile-image" name="profile_image" accept=".jpg,.jpeg,.png,.webp" required>
                        </div>

                        <div class="button-row">
                            <button type="submit">
                                <i class="bi bi-person-plus"></i>
                                <span>Crear cuenta admin</span>
                            </button>
                        </div>

                        <div class="button-row">
                            <a class="button-link" href="../html/create_account.php">
                                <i class="bi bi-person"></i>
                                <span>Registro estandar</span>
                            </a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </main>
</body>

</html>
