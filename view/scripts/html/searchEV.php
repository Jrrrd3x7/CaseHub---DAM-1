<?php require_once __DIR__ . '/../php/auth.php'; appUserController(); ?>
<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/../php/partials/head.php'; ?>
<body>
<?php require_once __DIR__ . '/../php/partials/header.php'; ?>
    <!-- Boton volver al inicio -->
    <section>
        <a class="return form" href="events.php"><i class="bi bi-arrow-left-circle"></i> Volver</a>
    </section>
    <section>
        <form action="#" method="get" autocomplete="on">
            <fieldset>
                <legend>Buscar Evento</legend>
                <label for="nom">Nombre Evento</label><br>
                <input type="text" id="nom" name="nom" placeholder="Release funda iPhone 16" minlength="3"
                    oninvalid="this.setCustomValidity('Mi­nim 3 caracters')" oninput="this.setCustomValidity('')">
                <br><br>

                <label for="tipus">Tipo</label><br>
                <select id="tipus" name="tipus" required>
                    <option value="">-- Selecciona --</option>
                    <option>Release funda nueva</option>
                    <option>Colaboracion</option>
                    <option>Meet & Greet</option>
                    <option>Test de producto</option>
                    <option>Workshop</option>
                    <option>Feria Tecnologica</option>
                </select>
                <br><br>
                <label for="data">Fecha</label><br>
                <input type="date" id="data" name="data" required>
                <br><br>
                <label for="ciutat">Ciudad</label><br>
                <input type="text" id="ciutat" name="ciutat" placeholder="Barcelona" pattern="[A-Za-zÃƒâ‚¬-ÃƒÂ¿ ]+"
                    title="Nomes lletres" required>
                <br><br>
                <button type="submit">Buscar</button>
            </fieldset>
        </form>
    </section>
<?php require_once __DIR__ . '/../php/partials/footer.php'; ?>

</body>

</html>
