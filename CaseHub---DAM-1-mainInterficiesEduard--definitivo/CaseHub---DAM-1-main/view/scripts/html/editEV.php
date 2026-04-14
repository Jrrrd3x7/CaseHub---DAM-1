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

        <section class="event-form-card" aria-labelledby="edit-event-title">
            <form action="#" method="post">
                <fieldset>
                    <legend id="edit-event-title">Editar evento</legend>
                    <p class="event-form-intro">Modifica los datos principales del evento a partir de su identificador.</p>

                    <div class="event-form-grid">
                        <div class="event-form-row">
                            <label for="id">ID del evento</label>
                            <input type="number" id="id" name="id" required min="1" inputmode="numeric">
                            <p class="event-helper">Introduce el numero del evento que quieres editar.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="nouNom">Nuevo nombre</label>
                            <input type="text" id="nouNom" name="nouNom" required minlength="5" maxlength="80"
                                placeholder="Nuevo nombre del evento">
                            <p class="event-helper">Escribe el nuevo titulo que se mostrara en la ficha del evento.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="novaData">Nueva fecha</label>
                            <input type="date" id="novaData" name="novaData" required>
                            <p class="event-helper">Selecciona la nueva fecha de celebracion.</p>
                        </div>

                        <div class="event-form-row">
                            <label for="novesPlaces">Nuevas plazas</label>
                            <input type="number" id="novesPlaces" name="novesPlaces" required min="1" max="500" inputmode="numeric">
                            <p class="event-helper">Actualiza el aforo disponible del evento.</p>
                        </div>

                        <div>
                            <button class="event-submit" type="submit">
                                <i class="bi bi-pencil-square"></i>
                                <span>Guardar cambios</span>
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
