<?php

class Database {
    private static $instance = null;
    
    public static function getConnection() {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config/database.php';
            
            $dsn = "pgsql:host={$config['host']};dbname={$config['dbname']};port={$config['port']}";
            
            try {
                // Verificar que el driver esté disponible
                $drivers = PDO::getAvailableDrivers();
                if (!in_array('pgsql', $drivers)) {
                    throw new PDOException("Driver pgsql no está disponible. Drivers disponibles: " . implode(", ", $drivers));
                }
                
                self::$instance = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

