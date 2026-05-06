<?php 
require_once __DIR__ . '/../php/auth.php';
require_once __DIR__ . '/../../../controller/EventController.php';

requireRole('admin');

if (!isset($eventController)) {
    $eventController = new EventController();
}

if (!isset($eventTypes)) {
    $eventTypes = $eventController->getEventTypes();
}

$formError = $formError ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<?php require_once __DIR__ . '/../php/partials/head.php'; ?>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <main class="event-form-page">
        <a class="event-back-link" href="events.php">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Volver a eventos</span>
        </a>

        <section class="event-form-card" aria-labelledby="event-title">
            <?php if ($formError !== ''): ?>
                <p class="event-form-error"><?php echo htmlspecialchars($formError); ?></p>
            <?php endif; ?>
            <form action="../php/createEV.php" method="post" autocomplete="on">
                <fieldset>
                    <legend id="event-title">Crear evento</legend>
                    <p class="event-form-intro">Completa la informacion principal del evento para publicarlo de forma clara y ordenada.</p>

                    <div class="event-form-grid">
                        <div class="event-form-row">
                            <label for="nom">Nombre del evento</label>
                            <input type="text" id="nom" name="nom" placeholder="Release funda Galaxy" required minlength="5" maxlength="80">
                            <p class="event-helper">Usa un nombre breve y facil de reconocer.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="tipus">Tipo de evento</label>
                            <select id="tipus" name="tipus" required>
                                <option value="">-- Selecciona una opcion --</option>
                                <?php foreach ($eventTypes as $type): ?>
                                    <option value="<?php echo htmlspecialchars($type['codigo']); ?>">
                                        <?php echo htmlspecialchars($type['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="event-helper">Selecciona la categoria que mejor describa la actividad.</p>
                        </div>
                            <div class="event-form-row">
                            <label for="resumen">Resumen</label>
                            <input type="text" id="resumen" name="resumen" placeholder="Texto breve para la tarjeta" maxlength="120">
                            <p class="event-helper">Se mostrara en la tarjeta del listado.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="descripcio">Descripcion</label>
                            <textarea id="descripcio" name="descripcio" required minlength="10" maxlength="500"
                                placeholder="Explica el objetivo, contenido y publico del evento."></textarea>
                            <p class="event-helper">Incluye informacion util para que cualquier persona entienda el evento.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="data">Fecha</label>
                            <input type="date" id="data" name="data" required>
                            <p class="event-helper">Selecciona la fecha prevista de celebracion.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Barcelona" maxlength="80">
                            <p class="event-helper">Puedes dejarlo vacio si el evento es online.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="places">Plazas disponibles</label>
                            <input type="number" id="places" name="places" required min="1" max="500" inputmode="numeric">
                            <p class="event-helper">Introduce un numero entre 1 y 500.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="ruta_imagen">Ruta de imagen</label>
                            <input type="text" id="ruta_imagen" name="ruta_imagen" placeholder="../../assets/fundas/funda.jpg" maxlength="255">
                            <p class="event-helper">Si lo dejas vacio se usara el logo como imagen temporal.</p>
                        </div>

                        <div>
                            <button class="event-submit" type="submit">
                                <i class="bi bi-calendar-plus"></i>
                                <span>Crear evento</span>
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </section>
    </main>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>
