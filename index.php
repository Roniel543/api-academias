<?php

require_once __DIR__ . '/controllers/ProfesorController.php';

// Manejar rutas de API
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, '/api/profesores') !== false) {
    ProfesorController::handleRequest();
} else {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode([
        'success' => false, 
        'message' => 'Endpoint no encontrado',
        'available_endpoints' => [
            'GET /api/profesores' => 'Listar todos los profesores',
            'GET /api/profesores/{id}' => 'Obtener un profesor',
            'POST /api/profesores' => 'Crear profesor',
            'PUT /api/profesores/{id}' => 'Actualizar profesor',
            'DELETE /api/profesores/{id}' => 'Eliminar profesor'
        ]
    ]);
}
    