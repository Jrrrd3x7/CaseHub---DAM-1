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

<header>
    <nav class="nav-pc">
        <div>
            <ul>
                <li><img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image"></li>
                <li><a href="index.html">TOP&nbsp;VENTAS</a></li>
                <li><a href="#">SERVICIOS</a></li>
                <li><a href="events.html">EVENTOS</a></li>
                <li><a href="#">PREMIUM</a></li>
                <li><a href="insert_card.html"><i class="bi bi-cart"></i></a></li>
                <li id="menu-item1" class="menu-item1" style="position: relative;">
                    <a><i class="bi bi-person"></i></a>
                    <ul id="submenu1" class="submenu1" style="position:absolute;top:40px;left:-100px;">
                        <li class="displayed-content"><a href="create_account.php">PERFIL</a></li>
                        <li class="displayed-content"><a href="login.html">CERRAR&nbsp;SESION</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="nav-phone">
        <div>
            <ul>
                <li id="menu-item2" class="menu-item2" style="position: relative;">
                    <a><i class="bi bi-list"></i></a>
                    <ul id="submenu2" class="submenu2" style="position:absolute;top:100px;left:-150px;">
                        <li class="displayed-content"><a href="index.html">TOP&nbsp;VENTAS</a></li>
                        <li class="displayed-content"><a href="#">SERVICIOS</a></li>
                        <li class="displayed-content"><a href="events.html">EVENTOS</a></li>
                        <li class="displayed-content"><a href="#">PREMIUM</a></li>
                        <li class="displayed-content"><a href="create_account.php">PERFIL</a></li>
                        <li class="displayed-content"><a href="login.html">CERRAR&nbsp;SESION</a></li>
                    </ul>
                    <img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image">
                </li>
                <li><a href="insert_card.html"><i class="bi bi-cart"></i></a></li>
            </ul>
        </div>
    </nav>
</header>

<body>
    <script src="../js/menus_desplegables.js"></script>

    <section>
        <button class="form">
            <a class="return" href="index.html"><i class="bi bi-arrow-left-circle"></i> Volver al Inicio</a>
        </button>
    </section>

    <section>
        <form id="Index" action="create_account.php" method="post" autocomplete="on">
            <fieldset>
                <legend><i class="bi bi-person"></i> Registrar cuenta </legend>
                <br>

                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required minlength="2" placeholder="Nombre"><br><br>

                <label for="surname">Apellido</label>
                <input type="text" id="surname" name="surname" required minlength="2" placeholder="Apellido"><br><br>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Ejemplo@email.com"><br><br>

                <span class="info">
                    Debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.
                </span><br><br>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                    required><br><br>

                <label for="password-confirm">Confirmar contraseña</label>
                <input type="password" id="password-confirm" name="password-confirm"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                    required><br><br>

                <label for="pais">País: </label>
                <select id="pais" name="pais" required>
                    <option value="">-- Selecciona un país --</option>
                    <option value="RU">Rusia</option>
                    <option value="ES">España</option>
                    <option value="MX">México</option>
                    <option value="AR">Argentina</option>
                    <option value="CO">Colombia</option>
                    <option value="CL">Chile</option>
                    <option value="PE">Perú</option>
                    <option value="US">Estados Unidos</option>
                    <option value="CA">Canadá</option>
                    <option value="FR">Francia</option>
                    <option value="DE">Alemania</option>
                    <option value="IT">Italia</option>
                    <option value="PT">Portugal</option>
                    <option value="UK">Reino Unido</option>
                </select><br><br>

                <button type="submit">
                    <i class="bi bi-person-plus"></i> Create Account
                </button>
            </fieldset>
        </form>
    </section>
</body>

<footer>
    <br>
    <p>©2025 CaseHUB</p>
    <p>FG82Fds?</p>
</footer>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexion = new mysqli("localhost", "root", "1234567890", "CaseHub");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $country = $_POST['pais'];
    $password = $_POST['password'];

    // Crear usuario
    $conexion->query("CALL CreateUser('$name', '$surname', '$email', '$country', '$password')");

    // Limpiar resultados previos
    while ($conexion->more_results() && $conexion->next_result()) {}

    // Mostrar usuarios
    $resultado = $conexion->query("CALL PrintUsers()");

    echo "<h2>Usuarios registrados:</h2>";

    while ($u = $resultado->fetch_assoc()) {
        echo $u["ID"]." - ".$u["Name"]." - ".$u["Surname"]." - ".$u["Email"]."<br>";
    }

    $conexion->close();
}
?>