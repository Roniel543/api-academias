<?php

require_once __DIR__ . '/../models/Profesor.php';

class ProfesorController {
    
    public static function handleRequest() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type');
        
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Parsear ruta
        $pathParts = array_filter(explode('/', trim($path, '/')));
        $pathParts = array_values($pathParts); // Reindexar
        
        $id = null;
        
        if (count($pathParts) >= 2 && $pathParts[0] === 'api' && $pathParts[1] === 'profesores') {
            $id = isset($pathParts[2]) ? $pathParts[2] : null;
        }
        
        switch ($method) {
            case 'GET':
                if ($id) {
                    self::getById($id);
                } else {
                    self::getAll();
                }
                break;
                
            case 'POST':
                self::create();
                break;
                
            case 'PUT':
                if ($id) {
                    self::update($id);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'ID requerido']);
                }
                break;
                
            case 'DELETE':
                if ($id) {
                    self::delete($id);
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'ID requerido']);
                }
                break;
                
            default:
                http_response_code(405);
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
    }
    
    private static function getAll() {
        try {
            $profesores = Profesor::getAll();
            echo json_encode(['success' => true, 'data' => $profesores], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()], JSON_UNESCAPED_UNICODE);
        }
    }
    
    private static function getById($id) {
        try {
            $profesor = Profesor::getById($id);
            if ($profesor) {
                echo json_encode(['success' => true, 'data' => $profesor]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Profesor no encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    private static function create() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['dni'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'DNI es requerido']);
                return;
            }
            
            $id = Profesor::create($data);
            http_response_code(201);
            echo json_encode(['success' => true, 'data' => ['id' => $id, ...$data]]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    private static function update($id) {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (empty($data)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Datos requeridos']);
                return;
            }
            
            $result = Profesor::update($id, $data);
            if ($result) {
                $profesor = Profesor::getById($id);
                echo json_encode(['success' => true, 'data' => $profesor]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Profesor no encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    private static function delete($id) {
        try {
            $result = Profesor::delete($id);
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Profesor eliminado']);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Profesor no encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

