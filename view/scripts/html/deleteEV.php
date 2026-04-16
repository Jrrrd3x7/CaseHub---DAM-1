<?php require_once __DIR__ . '/../php/auth.php'; requireRole('admin'); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../css/main.css">
    <link type="text/css" rel="stylesheet" href="../css/phone.css" media="(max-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/desktop.css" media="(min-width:1025px)">
    <link type="text/css" rel="stylesheet" href="../css/event-forms.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>CaseHUB</title>
</head>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <main class="event-form-page">
        <a class="event-back-link" href="events.php">
            <i class="bi bi-arrow-left-circle"></i>
            <span>Volver a eventos</span>
        </a>

        <section class="event-form-card" aria-labelledby="delete-event-title">
            <form action="#" method="post">
                <fieldset>
                    <legend id="delete-event-title">Eliminar evento</legend>
                    <p class="event-form-intro">Introduce el identificador del evento y confirma la accion antes de borrarlo.</p>

                    <div class="event-form-grid">
                        <div class="event-form-row">
                            <label for="id">ID del evento</label>
                            <input type="number" id="id" name="id" required min="1" inputmode="numeric">
                            <p class="event-helper">Usa el numero del evento que quieres eliminar.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="motiu">Motivo</label>
                            <textarea id="motiu" name="motiu" required minlength="5" maxlength="250"
                                placeholder="Explica el motivo de la eliminacion"></textarea>
                            <p class="event-helper">Este texto ayuda a justificar la eliminacion del evento.</p>
                        </div>

                        <div class="event-form-row-inline">
                            <input type="checkbox" id="confirm-delete" name="confirm-delete" required>
                            <label for="confirm-delete">Confirmo que quiero eliminar este evento</label>
                        </div>

                        <div>
                            <button class="event-submit danger" type="submit">
                                <i class="bi bi-trash"></i>
                                <span>Eliminar evento</span>
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
