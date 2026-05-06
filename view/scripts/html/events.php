    <?php
    require_once __DIR__ . '/../php/auth.php';

    $isAdmin = false;
    if (isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? '') === 'admin') {
        $isAdmin = true;
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <?php require_once __DIR__ . '/../php/partials/head.php'; ?>

    <body>
    <?php require_once __DIR__ . '/../php/partials/header.php'; ?>

        <section class="index_background"></section>
    
     <main>

        <section class="events-heading">
            <h1>AGENDA EVENTOS 2026</h1>
        </section>
            <div class="event-container">
                
        <?php if (empty($events)): ?>
                    <p>No hay eventos publicados ahora mismo.</p>
                <?php endif; ?>

                <?php foreach ($events as $event): ?>
                    <?php
                    $id = (int) $event['id'];
                    $name = htmlspecialchars($event['nombre']);
                    $summary = htmlspecialchars($event['resumen'] ?: $event['descripcion']);
                    $image = htmlspecialchars($event['ruta_imagen'] ?: '../../assets/imagenes/logo_CaseHub.png');
                    $city = htmlspecialchars($event['ciudad'] ?: 'Online');
                    $date = htmlspecialchars($event['fecha_evento']);
                    ?>
                    <article class="event-card">
                        <img src="<?php echo $image; ?>" alt="Imagen de <?php echo $name; ?>">
                        <h3><?php echo $name; ?></h3>
                        <p><?php echo $summary; ?></p>
                        <p class="event-meta"><?php echo $city; ?></p>
                        <time datetime="<?php echo $date; ?>"><?php echo eventDateLabel($event['fecha_evento']); ?></time><br>
                        <a href="event-detail.php?id=<?php echo $id; ?>" class="ver-mas">Ver evento</a>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
                <nav class="pagination" aria-label="Paginacion de eventos">
                    <?php if ($page > 1): ?>
                        <a href="events.php?page=<?php echo $page - 1; ?>" aria-label="Pagina anterior">&laquo;</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($i === $page): ?>
                            <span aria-current="page"><?php echo $i; ?></span>
                        <?php else: ?>
                            <a href="events.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="events.php?page=<?php echo $page + 1; ?>" aria-label="Pagina siguiente">&raquo;</a>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
                
            </div><br>
        </section>

        <section>
            <a class="return form" href="searchEV.php">BUSCAR EVENTO</a>
        </section>

        <?php if ($isAdmin): ?>
            <section>
                <a class="return form" href="../php/createEV.php">CREAR EVENTO</a>
            </section>

            <section>
                <a class="return form" href="../php/editEV.php">EDITAR EVENTO</a>
            </section>

            <section>
                <a class="return form" href="../php/deleteEV.php">BORRAR EVENTO</a>
            </section>
        <?php endif; ?>

        </main>

    <?php require_once __DIR__ . '/../php/partials/footer.php'; ?>

    </body>

    </html>
