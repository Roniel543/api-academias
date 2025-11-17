<?php

require_once __DIR__ . '/controllers/ProfesorController.php';

// Manejar rutas de API
if (strpos($_SERVER['REQUEST_URI'], '/api/profesores') !== false) {
    ProfesorController::handleRequest();
} else {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Endpoint no encontrado']);
}
    