<?php
require_once __DIR__ . '/../auth.php';

$userController = appUserController();
$currentUser = $userController->getCurrentUser();
$role = $currentUser['role'] ?? 'guest';
$isLogged = $userController->isLogged();
$isAdmin = $role === 'admin';
$canUseCard = $isLogged && $role !== 'admin';
$cartHref = $canUseCard ? '../php/insert_card.php' : 'insert_card.php';
?>
<header>
    <nav class="nav-pc">
        <div>
            <ul>
                <li><img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB"></li>
                <li><a href="index.php">TOP VENTAS</a></li>
                <li><a href="#">SERVICIOS</a></li>
                <li><a href="events.php">EVENTOS</a></li>
                <li><a href="#">PREMIUM</a></li>
                <li><a href="<?php echo htmlspecialchars($cartHref); ?>"><i class="bi bi-cart"></i><span class="sr-only">Carrito</span></a></li>
                <li id="menu-item1" class="menu-item1" style="position: relative;">
                    <a href="#" aria-label="Abrir menu de usuario"><i class="bi bi-person"></i></a>
                    <ul id="submenu1" class="submenu1" style="position:absolute;top:40px;left:-100px;">
                        <?php if ($isLogged): ?>
                            <li class="displayed-content"><a href="../php/account.php">PERFIL</a></li>
                            <li class="displayed-content"><a href="../php/logout.php">CERRAR SESION</a></li>
                        <?php else: ?>
                            <li class="displayed-content"><a href="login.php">INICIAR SESION</a></li>
                            <li class="displayed-content"><a href="create_account.php">REGISTRAR CUENTA</a></li>
                        <?php endif; ?>
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
                        <li class="displayed-content"><a href="index.php">TOP VENTAS</a></li>
                        <li class="displayed-content"><a href="#">SERVICIOS</a></li>
                        <li class="displayed-content"><a href="events.php">EVENTOS</a></li>
                        <li class="displayed-content"><a href="#">PREMIUM</a></li>
                        <?php if ($isLogged): ?>
                            <li class="displayed-content"><a href="../php/account.php">PERFIL</a></li>
                            <li class="displayed-content"><a href="../php/logout.php">CERRAR SESION</a></li>
                        <?php else: ?>
                            <li class="displayed-content"><a href="login.php">INICIAR SESION</a></li>
                            <li class="displayed-content"><a href="create_account.php">REGISTRAR CUENTA</a></li>
                        <?php endif; ?>
                    </ul>
                    <img src="../../assets/imagenes/logo_CaseHub.png" class="logo-image" alt="Logo CaseHUB">
                </li>
                <li><a href="<?php echo htmlspecialchars($cartHref); ?>"><i class="bi bi-cart"></i><span class="sr-only">Carrito</span></a></li>
            </ul>
        </div>
    </nav>
</header>
<script src="../js/menus_desplegables.js"></script>
