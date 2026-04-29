<?php require_once __DIR__ . '/../php/auth.php'; requireRole('standard'); ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/../php/partials/head.php'; ?>
<body>
<?php require_once __DIR__ . '/../php/partials/header.php'; ?>
    <section class="form">
        <a class="return" href="index.php"><i class="bi bi-arrow-left-circle"></i> Volver al Inicio</a>
    </section>
    <section class="form">
        <div>
            <form action="#" method="post" autocomplete="on">
                <fieldset>
                    <legend><i class="bi bi-credit-card"></i> Datos Targeta de Credito </legend>
                    <br>
                    <div>
                        <!-- Numero de Targeta -->
                        <input type="text" name="card_number" placeholder="Numero de Targeta" required pattern="\d{16}" minlength="16"
                            maxlength="16" title="El Numero de Targeta debe contener 16 numeros">
                        <br><br>

                        <!-- Fecha de Caducidad -->
                        <input type="text" name="expiry_date" placeholder="Fecha de Caducidad MM/AA" required pattern="(0[1-9]|1[0-2])\/\d{2}" minlength="5"
                            maxlength="5" title="La Fecha de Caducidad debe tener el formato MM/AA">
                        <br><br>

                        <!-- CVV -->
                        <input type="password" name="cvv" placeholder="CVV" required pattern="\d{3}" minlength="3" maxlength="3"
                            title="El CVV debe contener 3 numeros">
                        <br><br>

                        <!-- Boton -->
                        <input type="checkbox" id="remember" name="remember_card">
                        <label for="remember">Recordar Targeta</label>
                        <br><br>

                        <button type="submit">Pagar</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
<?php require_once __DIR__ . '/../php/partials/footer.php'; ?>

</body>

</html>
