<?php

require_once __DIR__ . '/../database/Database.php';

class Profesor {
    
    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM profesores");
        return $stmt->fetchAll();
    }
    
    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM profesores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public static function create($data) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO profesores (dni, nombre, apellidos, curso, anio_experiencia, foto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['dni'],
            $data['nombre'] ?? null,
            $data['apellidos'] ?? null,
            $data['curso'] ?? null,
            $data['anio_experiencia'] ?? null,
            $data['foto'] ?? null
        ]);
        return $db->lastInsertId();
    }
    
    public static function update($id, $data) {
        $db = Database::getConnection();
        $fields = [];
        $values = [];
        
        if (isset($data['dni'])) {
            $fields[] = "dni = ?";
            $values[] = $data['dni'];
        }
        if (isset($data['nombre'])) {
            $fields[] = "nombre = ?";
            $values[] = $data['nombre'];
        }
        if (isset($data['apellidos'])) {
            $fields[] = "apellidos = ?";
            $values[] = $data['apellidos'];
        }
        if (isset($data['curso'])) {
            $fields[] = "curso = ?";
            $values[] = $data['curso'];
        }
        if (isset($data['anio_experiencia'])) {
            $fields[] = "anio_experiencia = ?";
            $values[] = $data['anio_experiencia'];
        }
        if (isset($data['foto'])) {
            $fields[] = "foto = ?";
            $values[] = $data['foto'];
        }
        
        if (empty($fields)) {
            return false;
        }
        
        $values[] = $id;
        $sql = "UPDATE profesores SET " . implode(", ", $fields) . " WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute($values);
    }
    
    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM profesores WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

