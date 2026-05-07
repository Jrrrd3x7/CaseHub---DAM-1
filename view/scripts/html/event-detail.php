<?php
require_once __DIR__ . '/../php/auth.php';
require_once __DIR__ . '/../../../controller/EventController.php';

appUserController();

$eventController = new EventController();
$eventId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;
$event = $eventController->getEventById($eventId);
$media = $event ? $eventController->getEventMedia((int) $event['id']) : [];

function eventDetailDateLabel(string $date): string
{
    $timestamp = strtotime($date);

    if ($timestamp === false) {
        return $date;
    }

    $months = [
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre',
    ];

    return (int) date('j', $timestamp) . ' de ' . $months[(int) date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}
?>
<!DOCTYPE html>
<html lang="es">

<?php require_once __DIR__ . '/../php/partials/head.php'; ?>

<body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

    <main class="event-detail-page">
        <?php if (!$event): ?>
            <section class="event-detail">
                <h1>Evento no encontrado</h1>
                <p>El evento solicitado no existe o ya no esta publicado.</p>
                <a href="events.php" class="evento">Volver a eventos</a>
            </section>
        <?php else: ?>
            <?php
            $name = htmlspecialchars($event['nombre']);
            $description = nl2br(htmlspecialchars($event['descripcion']));
            $image = htmlspecialchars($event['ruta_imagen'] ?: '../../assets/imagenes/logo_CaseHub.png');
            $city = htmlspecialchars($event['ciudad'] ?: 'Online');
            $type = htmlspecialchars($event['tipo_evento'] ?: 'Evento');
            $places = $event['plazas_disponibles'] !== null ? (int) $event['plazas_disponibles'] : null;
            ?>
            <article>
                <section class="event-detail">
                    <img class="event-detail-image" src="<?php echo $image; ?>" alt="Imagen de <?php echo $name; ?>">
                    <h1><?php echo $name; ?></h1>
                    <p class="event-detail-type"><?php echo $type; ?></p>
                    <p><?php echo $description; ?></p>
                    <p class="event-detail-meta">Ciudad: <?php echo $city; ?></p>
                    <?php if ($places !== null): ?>
                        <p class="event-detail-meta">Plazas disponibles: <?php echo $places; ?></p>
                    <?php endif; ?>
                    <time datetime="<?php echo htmlspecialchars($event['fecha_evento']); ?>">
                        Fecha de evento: <?php echo eventDetailDateLabel($event['fecha_evento']); ?>
                    </time>

                    <?php foreach ($media as $item): ?>
                        <?php
                        $file = htmlspecialchars($item['archivo']);
                        $format = htmlspecialchars($item['formato'] ?: '');
                        $title = htmlspecialchars($item['titulo'] ?: $event['nombre']);
                        ?>
                        <?php if ($item['tipo'] === 'video'): ?>
                            <video class="event-detail-media" controls>
                                <source src="<?php echo $file; ?>" type="<?php echo $format ?: 'video/mp4'; ?>">
                            </video>
                        <?php elseif ($item['tipo'] === 'audio'): ?>
                            <audio controls>
                                <source src="<?php echo $file; ?>" type="<?php echo $format ?: 'audio/mpeg'; ?>">
                            </audio>
                        <?php elseif ($item['tipo'] === 'imagen' && $item['archivo'] !== $event['ruta_imagen']): ?>
                            <img class="event-detail-image" src="<?php echo $file; ?>" alt="<?php echo $title; ?>">
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <br><br>
                    <a href="events.php" class="evento">Volver a eventos</a>
                </section>
            </article>
        <?php endif; ?>
    </main>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>
</body>

</html>
