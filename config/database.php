<?php

// Configuración para producción (Render) y desarrollo local
// Usa getenv() que funciona mejor en diferentes entornos
return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'dbname' => getenv('DB_NAME') ?: 'academias',
    'username' => getenv('DB_USER') ?: 'postgres',
    'password' => getenv('DB_PASSWORD') ?: 'postgres',
    'port' => getenv('DB_PORT') ?: 5432
];

