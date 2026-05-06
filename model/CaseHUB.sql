--CaseHUB base de datos--
--Eduard,Daniel,Ivan,Jordi--
--14/04/26--

CREATE DATABASE IF NOT EXISTS CaseHub;

USE CaseHub;

DROP TABLE IF EXISTS busquedas_eventos;
DROP TABLE IF EXISTS ediciones_eventos;
DROP TABLE IF EXISTS eliminaciones_eventos;
DROP TABLE IF EXISTS multimedia_eventos;
DROP TABLE IF EXISTS tarjetas;
DROP TABLE IF EXISTS historial_login;
DROP TABLE IF EXISTS eventos;
DROP TABLE IF EXISTS tipos_evento;
DROP TABLE IF EXISTS usuarios;

DROP PROCEDURE IF EXISTS MostrarUsuarios;
DROP PROCEDURE IF EXISTS CrearUsuario;
DROP PROCEDURE IF EXISTS CrearEvento;
DROP PROCEDURE IF EXISTS EditarEvento;
DROP PROCEDURE IF EXISTS BuscarEvento;
DROP PROCEDURE IF EXISTS EliminarEvento;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    apellidos VARCHAR(60) NOT NULL,
    email VARCHAR(80) NOT NULL UNIQUE,
    pais VARCHAR(30) NOT NULL,
    telefono VARCHAR(20) NULL,
    rol VARCHAR(20) NOT NULL DEFAULT 'standard',
    contrasena VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE historial_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    email VARCHAR(80) NOT NULL,
    recordar_sesion BOOLEAN NOT NULL DEFAULT FALSE,
    acceso_correcto BOOLEAN NOT NULL DEFAULT FALSE,
    fecha_intento TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE tarjetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    ultimos_4 CHAR(4) NOT NULL,
    mes_caducidad INT NOT NULL,
    anio_caducidad INT NOT NULL,
    recordar_tarjeta BOOLEAN NOT NULL DEFAULT FALSE,
    token_pago VARCHAR(255) NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE tipos_evento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(40) NOT NULL UNIQUE,
    nombre VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario_creador INT NULL,
    id_usuario_editor INT NULL,
    id_tipo_evento INT NULL,
    nombre VARCHAR(80) NOT NULL,
    resumen VARCHAR(120) NULL,
    descripcion TEXT NOT NULL,
    ciudad VARCHAR(80) NULL,
    fecha_evento DATE NOT NULL,
    plazas_disponibles INT NULL,
    pagina_detalle VARCHAR(100) NULL,
    ruta_imagen VARCHAR(255) NULL,
    estado VARCHAR(20) NOT NULL DEFAULT 'publicado',
    fecha_borrado TIMESTAMP NULL DEFAULT NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario_creador) REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario_editor) REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (id_tipo_evento) REFERENCES tipos_evento(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE multimedia_eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    archivo VARCHAR(255) NOT NULL,
    titulo VARCHAR(100) NULL,
    formato VARCHAR(100) NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_evento) REFERENCES eventos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE ediciones_eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    id_usuario INT NULL,
    nombre_anterior VARCHAR(80) NOT NULL,
    nombre_nuevo VARCHAR(80) NOT NULL,
    fecha_anterior DATE NOT NULL,
    fecha_nueva DATE NOT NULL,
    plazas_anteriores INT NULL,
    plazas_nuevas INT NULL,
    fecha_edicion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_evento) REFERENCES eventos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE busquedas_eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    nombre_buscado VARCHAR(80) NULL,
    tipo_buscado VARCHAR(80) NOT NULL,
    fecha_buscada DATE NOT NULL,
    ciudad_buscada VARCHAR(80) NOT NULL,
    fecha_busqueda TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE eliminaciones_eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    id_usuario INT NULL,
    motivo VARCHAR(250) NOT NULL,
    confirmado BOOLEAN NOT NULL DEFAULT FALSE,
    fecha_eliminacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_evento) REFERENCES eventos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

INSERT INTO usuarios (nombre, apellidos, email, pais, telefono, rol, contrasena)
VALUES
    ('Jordi', 'Messi', 'jordi@email.com', 'ES', '+34 600111222', 'admin', 'jordi123'),
    ('Daniil', 'Maximov', 'dmaximov@email.com', 'RU', '+7 9001234567', 'premium', 'dmx123');

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
    ('luxury', 'Luxury');

INSERT INTO eventos (
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
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'meet-greet'), 'OPPO Reno 14 Series 5G', 'Consigue una firma de Lamine Yamal.', 'Descubre el nuevo OPPO Reno 14 Series 5G con increibles mejoras en camara y rendimiento con la presencia de Lamine Yamal en nuestra tienda de Barcelona.', 'Barcelona', '2026-04-23', 120, 'event-detail.php', '../../assets/fundas/lyoppo.jpg', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'showroom'), 'Disfruta de lo mejor de Michael Jackson', 'Se el primero en escucharlo.', 'El Iphone 17 pro, el movil con los mejores altavoces del mercado, disponible en nuestra tienda de Madrid.', 'Madrid', '2026-03-14', 150, 'event-detail.php', '../../assets/fundas/OTW.jpg', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'test-producto'), 'UAG Essential Armor', 'Lo mejor para proteger tu telefono.', 'Prueba con nosotros la nueva funda UAG Essential Armor aprobada por la NASA.', 'Valencia', '2026-03-15', 90, 'event-detail.php', '../../assets/fundas/funda.jpg', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'concurso'), 'Saca tu creatividad', 'Seras el ganador del sorteo?', 'Dirigete a cualquiera de nuestras tiendas y saca tu creatividad personalizando una funda para tu dispositivo movil y entra en el sorteo de unos auriculares inalambricos.', 'Sevilla', '2026-04-15', 60, 'event-detail.php', '../../assets/fundas/sakura_case.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'gaming'), 'Participa en nuestro torneo gaming', 'Demuestra tu nivel.', 'El ganador ganara un pase para STEAM, unos cascos gaming, un teclado y un raton gaming.', 'Bilbao', '2026-05-14', 180, 'event-detail.php', '../../assets/fundas/Designer.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'workshop'), 'Monta tu setup perfecto', 'Para todo tipo de publico.', 'Como montar un setup gaming o de estudio: aprende sobre ergonomia, iluminacion y cableado en la exposicion de setups reales.', 'Malaga', '2026-05-02', 70, 'event-detail.php', '../../assets/fundas/setup.jpg', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'workshop'), 'Taller de Seguridad Digital', 'Protege tu movil y tus datos.', 'Como proteger tu movil y tus datos: aprenderas a crear copias de seguridad y a evitar estafas online.', 'Zaragoza', '2026-04-03', 110, 'event-detail.php', '../../assets/fundas/ciberseguridad.jpg', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'resistencia'), 'Clinica del Movil', 'Repara tu dispositivo movil.', 'Consejos de uso y mantenimiento para alargar la vida de tu movil, optimizar la bateria y mejorar el almacenamiento para aumentar su rendimiento.', 'Lisboa', '2026-04-26', 200, 'event-detail.php', '../../assets/fundas/repa.png', 'publicado');

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'imagen', ruta_imagen, CONCAT(nombre, ' imagen principal'), 'image/png'
FROM eventos
WHERE ruta_imagen IS NOT NULL;

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'video', '../../assets/videos/oppoly.mp4', 'Video OPPO Reno 14 Series 5G', 'video/mp4'
FROM eventos
WHERE nombre = 'OPPO Reno 14 Series 5G';

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'audio', '../../assets/audio/mj.mp3', 'Audio Michael Jackson', 'audio/mpeg'
FROM eventos
WHERE nombre = 'Disfruta de lo mejor de Michael Jackson';

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'audio', '../../assets/audio/asc.mp3', 'Audio Seguridad Digital', 'audio/mpeg'
FROM eventos
WHERE nombre = 'Taller de Seguridad Digital';

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'video', '../../assets/videos/reparacion.mp4', 'Video Clinica del Movil', 'video/mp4'
FROM eventos
WHERE nombre = 'Clinica del Movil';

DELIMITER $$

CREATE PROCEDURE MostrarUsuarios()
BEGIN
    SELECT
        id,
        nombre,
        apellidos,
        email,
        pais,
        fecha_creacion,
        fecha_actualizacion
    FROM usuarios
    ORDER BY id;
END $$

CREATE PROCEDURE CrearUsuario(
    IN p_nombre VARCHAR(40),
    IN p_apellidos VARCHAR(60),
    IN p_email VARCHAR(80),
    IN p_pais VARCHAR(30),
    IN p_telefono VARCHAR(20),
    IN p_contrasena VARCHAR(255)
)
BEGIN
    INSERT INTO usuarios (nombre, apellidos, email, pais, telefono, contrasena)
    VALUES (p_nombre, p_apellidos, p_email, p_pais, p_telefono, p_contrasena);
END $$

CREATE PROCEDURE CrearEvento(
    IN p_id_usuario INT,
    IN p_tipo_evento VARCHAR(40),
    IN p_nombre VARCHAR(80),
    IN p_descripcion TEXT,
    IN p_fecha_evento DATE,
    IN p_plazas INT,
    IN p_ciudad VARCHAR(80)
)
BEGIN
    INSERT INTO eventos (
        id_usuario_creador,
        id_usuario_editor,
        id_tipo_evento,
        nombre,
        descripcion,
        ciudad,
        fecha_evento,
        plazas_disponibles,
        pagina_detalle
    )
    VALUES (
        p_id_usuario,
        p_id_usuario,
        (SELECT id FROM tipos_evento WHERE codigo = p_tipo_evento LIMIT 1),
        p_nombre,
        p_descripcion,
        p_ciudad,
        p_fecha_evento,
        p_plazas,
        'event-detail.php'
    );
END $$

CREATE PROCEDURE EditarEvento(
    IN p_id_evento INT,
    IN p_id_usuario INT,
    IN p_nombre_nuevo VARCHAR(80),
    IN p_fecha_nueva DATE,
    IN p_plazas_nuevas INT
)
BEGIN
    DECLARE v_nombre_anterior VARCHAR(80);
    DECLARE v_fecha_anterior DATE;
    DECLARE v_plazas_anteriores INT;

    SELECT nombre, fecha_evento, plazas_disponibles
    INTO v_nombre_anterior, v_fecha_anterior, v_plazas_anteriores
    FROM eventos
    WHERE id = p_id_evento;

    UPDATE eventos
    SET
        nombre = p_nombre_nuevo,
        fecha_evento = p_fecha_nueva,
        plazas_disponibles = p_plazas_nuevas,
        id_usuario_editor = p_id_usuario
    WHERE id = p_id_evento;

    INSERT INTO ediciones_eventos (
        id_evento,
        id_usuario,
        nombre_anterior,
        nombre_nuevo,
        fecha_anterior,
        fecha_nueva,
        plazas_anteriores,
        plazas_nuevas
    )
    VALUES (
        p_id_evento,
        p_id_usuario,
        v_nombre_anterior,
        p_nombre_nuevo,
        v_fecha_anterior,
        p_fecha_nueva,
        v_plazas_anteriores,
        p_plazas_nuevas
    );
END $$

CREATE PROCEDURE BuscarEvento(
    IN p_id_usuario INT,
    IN p_nombre_buscado VARCHAR(80),
    IN p_tipo_buscado VARCHAR(80),
    IN p_fecha_buscada DATE,
    IN p_ciudad_buscada VARCHAR(80)
)
BEGIN
    INSERT INTO busquedas_eventos (
        id_usuario,
        nombre_buscado,
        tipo_buscado,
        fecha_buscada,
        ciudad_buscada
    )
    VALUES (
        p_id_usuario,
        p_nombre_buscado,
        p_tipo_buscado,
        p_fecha_buscada,
        p_ciudad_buscada
    );

    SELECT
        eventos.id,
        eventos.nombre,
        tipos_evento.nombre AS tipo_evento,
        eventos.ciudad,
        eventos.fecha_evento,
        eventos.plazas_disponibles,
        eventos.estado
    FROM eventos
    LEFT JOIN tipos_evento ON tipos_evento.id = eventos.id_tipo_evento
    WHERE (p_nombre_buscado IS NULL OR p_nombre_buscado = '' OR eventos.nombre LIKE CONCAT('%', p_nombre_buscado, '%'))
      AND (p_tipo_buscado IS NULL OR p_tipo_buscado = '' OR tipos_evento.nombre = p_tipo_buscado OR tipos_evento.codigo = p_tipo_buscado)
      AND eventos.fecha_evento = p_fecha_buscada
      AND eventos.ciudad = p_ciudad_buscada
      AND eventos.estado <> 'borrado'
    ORDER BY eventos.fecha_evento, eventos.nombre;
END $$

CREATE PROCEDURE EliminarEvento(
    IN p_id_evento INT,
    IN p_id_usuario INT,
    IN p_motivo VARCHAR(250),
    IN p_confirmado BOOLEAN
)
BEGIN
    INSERT INTO eliminaciones_eventos (
        id_evento,
        id_usuario,
        motivo,
        confirmado
    )
    VALUES (
        p_id_evento,
        p_id_usuario,
        p_motivo,
        p_confirmado
    );

    IF p_confirmado THEN
        UPDATE eventos
        SET
            estado = 'borrado',
            fecha_borrado = CURRENT_TIMESTAMP,
            id_usuario_editor = p_id_usuario
        WHERE id = p_id_evento;
    END IF;
END $$

DELIMITER ;

CALL MostrarUsuarios();
