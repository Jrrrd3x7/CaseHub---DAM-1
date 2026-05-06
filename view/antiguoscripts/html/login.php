<?php require_once __DIR__ . '/../php/auth.php'; appUserController(); ?>
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
    <title>CaseHUB</title>
</head>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <main class="form-page">
        <a class="back-link" href="index.php">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Volver al inicio</span>
        </a>

        <section class="form-card" aria-labelledby="login-title">
            <form id="loginForm" action="../php/login.php" method="post" autocomplete="on">
                <fieldset>
                    <legend id="login-title"><i class="bi bi-person"></i> Iniciar sesion</legend>
                    <p class="form-intro">Introduce tu correo y tu contrasena para acceder a tu cuenta.</p>
                    <p class="required-note">Los campos marcados como obligatorios deben completarse antes de enviar el formulario.</p>
                    <p id="login-message" class="helper-text" style="display:none;"></p>

                    <div class="form-grid">
                        <div class="form-row">
                            <label for="email">Correo electronico</label>
                            <input type="email" id="email" name="email" placeholder="nombre@ejemplo.com" required
                                minlength="10" maxlength="80" autocomplete="email"
                                aria-describedby="email-help email-feedback">
                            <span id="email-help" class="helper-text">Usa el correo con el que registraste tu cuenta.</span>
                            <span id="email-feedback" class="feedback">El formato del correo debe ser valido.</span>
                        </div>

                        <div class="form-row">
                            <label for="password">Contrasena</label>
                            <input type="password" id="password" name="password" placeholder="Introduce tu contrasena"
                                required maxlength="255" autocomplete="current-password"
                                aria-describedby="password-help password-feedback">
                            <span id="password-help" class="helper-text">Introduce la contrasena con la que registraste tu cuenta.</span>
                            <span id="password-feedback" class="feedback">Revisa la contrasena antes de continuar.</span>
                        </div>

                        <div class="form-row-inline">
                            <input type="checkbox" id="remember" name="remember" autocomplete="off">
                            <label for="remember">Mantener la sesion iniciada</label>
                        </div>

                        <div class="button-row">
                            <button type="submit">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Iniciar sesion</span>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </main>

    <script>
        (function () {
            const params = new URLSearchParams(window.location.search);
            const message = params.get('error') || params.get('success');
            const messageBox = document.getElementById('login-message');

            if (!message || !messageBox) {
                return;
            }

            messageBox.textContent = message;
            messageBox.style.display = 'block';
            messageBox.style.color = params.get('error') ? '#b42318' : '#027a48';
        }());
    </script>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>
