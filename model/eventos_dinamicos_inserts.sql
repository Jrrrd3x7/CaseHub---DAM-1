USE CaseHub;

INSERT INTO tipos_evento (codigo, nombre)
VALUES
    ('release', 'Release nueva funda'),
    ('colaboracion', 'Colaboracion'),
    ('meet-greet', 'Meet and Greet'),
    ('resistencia', 'Test de resistencia'),
    ('workshop', 'Workshop'),
    ('showroom', 'Showroom'),
    ('concurso', 'Concurso de diseno'),
    ('test-producto', 'Test de producto'),
    ('feria-tecnologica', 'Feria Tecnologica'),
    ('premium', 'Premium'),
    ('gaming', 'Gaming'),
    ('eco', 'Eco'),
    ('luxury', 'Luxury')
ON DUPLICATE KEY UPDATE
    nombre = VALUES(nombre);

INSERT INTO eventos (
    id,
    id_usuario_creador,
    id_usuario_editor,
    id_tipo_evento,
    nombre,
    resumen,
    descripcion,
    ciudad,
    fecha_evento,
    plazas_disponibles,
    pagina_detalle,
    ruta_imagen,
    estado
)
VALUES
(1, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'meet-greet'), 'OPPO Reno 14 Series 5G', 'Consigue una firma de Lamine Yamal.', 'Descubre el nuevo OPPO Reno 14 Series 5G con increibles mejoras en camara y rendimiento con la presencia de Lamine Yamal en nuestra tienda de Barcelona.', 'Barcelona', '2026-04-23', 120, 'event-detail.php', '../../assets/fundas/lyoppo.jpg', 'publicado'),
(2, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'showroom'), 'Disfruta de lo mejor de Michael Jackson', 'Se el primero en escucharlo.', 'El Iphone 17 pro, el movil con los mejores altavoces del mercado, disponible en nuestra tienda de Madrid.', 'Madrid', '2026-03-14', 150, 'event-detail.php', '../../assets/fundas/OTW.jpg', 'publicado'),
(3, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'test-producto'), 'UAG Essential Armor', 'Lo mejor para proteger tu telefono.', 'Prueba con nosotros la nueva funda UAG Essential Armor aprobada por la NASA.', 'Valencia', '2026-03-15', 90, 'event-detail.php', '../../assets/fundas/funda.jpg', 'publicado'),
(4, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'concurso'), 'Saca tu creatividad', 'Seras el ganador del sorteo?', 'Dirigete a cualquiera de nuestras tiendas y saca tu creatividad personalizando una funda para tu dispositivo movil y entra en el sorteo de unos auriculares inalambricos.', 'Sevilla', '2026-04-15', 60, 'event-detail.php', '../../assets/fundas/sakura_case.png', 'publicado'),
(5, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'gaming'), 'Participa en nuestro torneo gaming', 'Demuestra tu nivel.', 'El ganador ganara un pase para STEAM, unos cascos gaming, un teclado y un raton gaming.', 'Bilbao', '2026-05-14', 180, 'event-detail.php', '../../assets/fundas/Designer.png', 'publicado'),
(6, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'workshop'), 'Monta tu setup perfecto', 'Para todo tipo de publico.', 'Como montar un setup gaming o de estudio: aprende sobre ergonomia, iluminacion y cableado en la exposicion de setups reales.', 'Malaga', '2026-05-02', 70, 'event-detail.php', '../../assets/fundas/setup.jpg', 'publicado'),
(7, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'workshop'), 'Taller de Seguridad Digital', 'Protege tu movil y tus datos.', 'Como proteger tu movil y tus datos: aprenderas a crear copias de seguridad y a evitar estafas online.', 'Zaragoza', '2026-04-03', 110, 'event-detail.php', '../../assets/fundas/ciberseguridad.jpg', 'publicado'),
(8, NULL, NULL, (SELECT id FROM tipos_evento WHERE codigo = 'resistencia'), 'Clinica del Movil', 'Repara tu dispositivo movil.', 'Consejos de uso y mantenimiento para alargar la vida de tu movil, optimizar la bateria y mejorar el almacenamiento para aumentar su rendimiento.', 'Lisboa', '2026-04-26', 200, 'event-detail.php', '../../assets/fundas/repa.png', 'publicado')
ON DUPLICATE KEY UPDATE
    id_usuario_creador = VALUES(id_usuario_creador),
    id_usuario_editor = VALUES(id_usuario_editor),
    id_tipo_evento = VALUES(id_tipo_evento),
    nombre = VALUES(nombre),
    resumen = VALUES(resumen),
    descripcion = VALUES(descripcion),
    ciudad = VALUES(ciudad),
    fecha_evento = VALUES(fecha_evento),
    plazas_disponibles = VALUES(plazas_disponibles),
    pagina_detalle = VALUES(pagina_detalle),
    ruta_imagen = VALUES(ruta_imagen),
    estado = VALUES(estado);

DELETE FROM multimedia_eventos
WHERE id_evento BETWEEN 1 AND 8;

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'imagen', ruta_imagen, CONCAT(nombre, ' imagen principal'), 'image/png'
FROM eventos
WHERE id BETWEEN 1 AND 8
  AND ruta_imagen IS NOT NULL;

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
VALUES
    (1, 'video', '../../assets/videos/oppoly.mp4', 'Video OPPO Reno 14 Series 5G', 'video/mp4'),
    (2, 'audio', '../../assets/audio/mj.mp3', 'Audio Michael Jackson', 'audio/mpeg'),
    (7, 'audio', '../../assets/audio/asc.mp3', 'Audio Seguridad Digital', 'audio/mpeg'),
    (8, 'video', '../../assets/videos/reparacion.mp4', 'Video Clinica del Movil', 'video/mp4');
