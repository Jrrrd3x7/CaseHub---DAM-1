<?php

class EventController
{
    private PDO $conn;

    public function __construct()
    {
        $dbConfig = require __DIR__ . '/../config/database.php';

        $this->conn = new PDO(
            "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['database']};charset=utf8mb4",
            $dbConfig['username'],
            $dbConfig['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function getPaginatedEvents(int $page, int $perPage = 6): array
    {
        $page = max(1, $page);
        $perPage = max(1, $perPage);
        $offset = ($page - 1) * $perPage;

        $totalStmt = $this->conn->query(
            "SELECT COUNT(*) FROM eventos WHERE estado <> 'borrado'"
        );
        $totalEvents = (int) $totalStmt->fetchColumn();
        $totalPages = max(1, (int) ceil($totalEvents / $perPage));

        if ($page > $totalPages) {
            $page = $totalPages;
            $offset = ($page - 1) * $perPage;
        }

        $stmt = $this->conn->prepare(
            "SELECT
                eventos.id,
                eventos.nombre,
                eventos.resumen,
                eventos.descripcion,
                eventos.ciudad,
                eventos.fecha_evento,
                eventos.plazas_disponibles,
                eventos.ruta_imagen,
                tipos_evento.nombre AS tipo_evento
            FROM eventos
            LEFT JOIN tipos_evento ON tipos_evento.id = eventos.id_tipo_evento
            WHERE eventos.estado <> 'borrado'
            ORDER BY eventos.fecha_evento ASC, eventos.id ASC
            LIMIT :limit OFFSET :offset"
        );
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return [
            'events' => $stmt->fetchAll(),
            'page' => $page,
            'perPage' => $perPage,
            'totalEvents' => $totalEvents,
            'totalPages' => $totalPages
        ];
    }

    public function getEventById(int $id): ?array
    {
        $stmt = $this->conn->prepare(
            "SELECT
                eventos.id,
                eventos.nombre,
                eventos.resumen,
                eventos.descripcion,
                eventos.ciudad,
                eventos.fecha_evento,
                eventos.plazas_disponibles,
                eventos.ruta_imagen,
                eventos.estado,
                tipos_evento.nombre AS tipo_evento
            FROM eventos
            LEFT JOIN tipos_evento ON tipos_evento.id = eventos.id_tipo_evento
            WHERE eventos.id = :id
              AND eventos.estado <> 'borrado'
            LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        $event = $stmt->fetch();

        return $event ?: null;
    }

    public function getEventMedia(int $eventId): array
    {
        $stmt = $this->conn->prepare(
            "SELECT tipo, archivo, titulo, formato
            FROM multimedia_eventos
            WHERE id_evento = :id_evento
            ORDER BY FIELD(tipo, 'video', 'imagen', 'audio'), id"
        );
        $stmt->execute([':id_evento' => $eventId]);

        return $stmt->fetchAll();
    }

    public function getEventTypes(): array
    {
        $stmt = $this->conn->query(
            "SELECT codigo, nombre
            FROM tipos_evento
            ORDER BY nombre"
        );

        return $stmt->fetchAll();
    }

    public function createEvent(array $data): int
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO eventos (
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
            VALUES (
                :user_id,
                :user_id,
                (SELECT id FROM tipos_evento WHERE codigo = :type_code LIMIT 1),
                :name,
                :summary,
                :description,
                :city,
                :event_date,
                :places,
                'event-detail.php',
                :image_path,
                'publicado'
            )"
        );
        $stmt->execute([
            ':user_id' => $data['user_id'],
            ':type_code' => $data['type_code'],
            ':name' => $data['name'],
            ':summary' => $data['summary'],
            ':description' => $data['description'],
            ':city' => $data['city'],
            ':event_date' => $data['event_date'],
            ':places' => $data['places'],
            ':image_path' => $data['image_path'],
        ]);

        $eventId = (int) $this->conn->lastInsertId();

        if (!empty($data['image_path'])) {
            $mediaStmt = $this->conn->prepare(
                "INSERT INTO multimedia_eventos (id_evento, tipo, archivo, titulo, formato)
                VALUES (:event_id, 'imagen', :file, :title, 'image/png')"
            );
            $mediaStmt->execute([
                ':event_id' => $eventId,
                ':file' => $data['image_path'],
                ':title' => $data['name'] . ' imagen principal',
            ]);
        }

        return $eventId;
    }
}
