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
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'premium'), 'Fundas Premium 2026', 'Coleccion sostenible y elegante.', 'Coleccion premium con materiales sostenibles y diseno elegante.', 'Barcelona', '2026-03-15', 120, 'evento1.html', '../../assets/fundas/sakura_case.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'gaming'), 'Fundas Gaming Antigolpes', 'Proteccion extrema para gamers.', 'Proteccion extrema para gamers con diseno ergonomico y ventilacion termica.', 'Madrid', '2026-04-10', 150, 'evento2.html', '../../assets/fundas/black_case.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'eco'), 'Fundas Eco Friendly', 'Materiales reciclados.', 'Fundas fabricadas con materiales reciclados y sostenibles.', 'Valencia', '2026-05-05', 90, 'evento3.html', '../../assets/fundas/patriot_case.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'luxury'), 'Fundas Luxury Edition', 'Diseno exclusivo.', 'Edicion de lujo con acabados metalicos premium.', 'Sevilla', '2026-06-12', 60, 'evento4.html', '../../assets/fundas/mi_amor.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'resistencia'), 'Fundas Transparentes Pro', 'Pruebas extremas.', 'Proteccion transparente con alta resistencia a impactos.', 'Bilbao', '2026-07-01', 180, 'evento5.html', '../../assets/fundas/shark_case.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'workshop'), 'Fundas Minimal Series', 'Crea tu funda.', 'Diseno minimalista con maxima proteccion.', 'Malaga', '2026-08-20', 70, 'evento6.html', '../../assets/fundas/sakura_case.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'colaboracion'), 'Fundas Urban Style', 'Nueva coleccion exclusiva.', 'Diseno urbano moderno inspirado en streetwear.', 'Zaragoza', '2026-09-10', 110, 'evento7.html', '../../assets/fundas/mi_amor.png', 'publicado'),
(1, 1, (SELECT id FROM tipos_evento WHERE codigo = 'feria-tecnologica'), 'Fundas Future Tech', 'Presentacion global.', 'Diseno futurista con materiales de ultima generacion.', 'Lisboa', '2026-10-05', 200, 'evento8.html', '../../assets/fundas/black_case.png', 'publicado');

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'imagen', ruta_imagen, CONCAT(nombre, ' imagen principal'), 'image/png'
FROM eventos
WHERE ruta_imagen IS NOT NULL;

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'video', '../../assets/videos/videoplayback.mp4', CONCAT(nombre, ' video'), 'video/mp4'
FROM eventos;

INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
SELECT id, 'audio', '../../assets/videos/Sonido de la Naturaleza.mp3', CONCAT(nombre, ' audio'), 'audio/mp3'
FROM eventos;

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
        plazas_disponibles
    )
    VALUES (
        p_id_usuario,
        p_id_usuario,
        (SELECT id FROM tipos_evento WHERE codigo = p_tipo_evento LIMIT 1),
        p_nombre,
        p_descripcion,
        p_ciudad,
        p_fecha_evento,
        p_plazas
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
