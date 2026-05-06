<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../../controller/EventController.php';

$userController = requireRole('admin');
$currentUser = $userController->getCurrentUser();
$eventController = new EventController();
$formError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['nom'] ?? '');
    $summary = trim($_POST['resumen'] ?? '');
    $typeCode = trim($_POST['tipus'] ?? '');
    $description = trim($_POST['descripcio'] ?? '');
    $city = trim($_POST['ciudad'] ?? '');
    $eventDate = trim($_POST['data'] ?? '');
    $places = filter_input(INPUT_POST, 'places', FILTER_VALIDATE_INT);
    $imagePath = trim($_POST['ruta_imagen'] ?? '');

    if ($name === '' || $typeCode === '' || $description === '' || $eventDate === '' || $places === false) {
        $formError = 'Rellena todos los campos obligatorios correctamente.';
    } else {
        $eventId = $eventController->createEvent([
            'user_id' => (int) $currentUser['id'],
            'type_code' => $typeCode,
            'name' => $name,
            'summary' => $summary !== '' ? $summary : substr($description, 0, 120),
            'description' => $description,
            'city' => $city !== '' ? $city : null,
            'event_date' => $eventDate,
            'places' => $places,
            'image_path' => $imagePath !== '' ? $imagePath : null,
        ]);

        redirectTo('../html/event-detail.php?id=' . $eventId);
    }
}

$eventTypes = $eventController->getEventTypes();

include __DIR__ . '/../html/createEV.php';
