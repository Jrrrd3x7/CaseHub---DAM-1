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

        <section class="form-card" aria-labelledby="account-title">
            <form id="accountForm" action="../php/register.php" method="post" autocomplete="on">
                <fieldset>
                    <legend id="account-title"><i class="bi bi-person"></i> Registro y datos del perfil</legend>
                    <p class="form-intro">Esta pagina se usa para registrar una cuenta nueva y actualizar los datos basicos del perfil dentro de este proyecto.</p>
                    <p class="required-note">Todos los campos son obligatorios. Revisa especialmente el formato del correo y la contrasena.</p>
                    <p id="form-message" class="helper-text" style="display:none;"></p>

                    <div class="form-grid">
                        <div class="form-row">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" required minlength="2" maxlength="40"
                                placeholder="Nombre" autocomplete="given-name" aria-describedby="name-help">
                            <span id="name-help" class="helper-text">Introduce tu nombre o el nombre del perfil.</span>
                        </div>

                        <div class="form-row">
                            <label for="surname">Apellido</label>
                            <input type="text" id="surname" name="surname" required minlength="2" maxlength="60"
                                placeholder="Apellido" autocomplete="family-name" aria-describedby="surname-help">
                            <span id="surname-help" class="helper-text">Usa tus apellidos tal como quieres que aparezcan en la cuenta.</span>
                        </div>

                        <div class="form-row">
                            <label for="email">Correo electronico</label>
                            <input type="email" id="email" name="email" required maxlength="80"
                                placeholder="ejemplo@email.com" autocomplete="email"
                                aria-describedby="email-help">
                            <span id="email-help" class="helper-text">Este correo se utilizara para identificar el perfil.</span>
                        </div>

                        <div class="form-row">
                            <label for="phone">Telefono</label>
                            <input type="tel" id="phone" name="phone" required minlength="9" maxlength="20"
                                placeholder="+34 612345678" autocomplete="tel"
                                pattern="^[0-9+ ]{9,20}$" aria-describedby="phone-help">
                            <span id="phone-help" class="helper-text">Introduce un telefono valido con numeros, espacios o prefijo internacional.</span>
                        </div>

                        <div class="form-row">
                            <label for="password">Contrasena</label>
                            <input type="password" id="password" name="password"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                required minlength="8" maxlength="50" autocomplete="new-password"
                                aria-describedby="password-help">
                            <span id="password-help" class="helper-text">Debe tener al menos 8 caracteres, una mayuscula, una minuscula, un numero y un simbolo.</span>
                        </div>

                        <div class="form-row">
                            <label for="password-confirm">Confirmar contrasena</label>
                            <input type="password" id="password-confirm" name="password-confirm"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                required minlength="8" maxlength="50" autocomplete="new-password"
                                aria-describedby="password-confirm-help">
                            <span id="password-confirm-help" class="helper-text">Vuelve a escribir la contrasena con el mismo formato.</span>
                        </div>

                        <div class="form-row">
                            <label for="pais">Pais</label>
                            <select id="pais" name="pais" required aria-describedby="pais-help">
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
                            <span id="pais-help" class="helper-text">Selecciona tu pais de residencia o el asociado al perfil.</span>
                        </div>
                        
                        <div class="button-row">
                            <button type="submit">
                                <i class="bi bi-person-plus"></i>
                                <span>Guardar cuenta</span>
                            </button>
                        </div>

                        <div class="button-row">
                            <a class="button-link" href="login.php">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>Ya tienes cuenta?</span>
                            </a>
                        </div>

                        <div class="button-row">
                            <a class="button-link" href="../php/register_admin.php">
                                <i class="bi bi-shield-lock"></i>
                                <span>Registro admin</span>
                            </a>
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
            const messageBox = document.getElementById('form-message');

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
