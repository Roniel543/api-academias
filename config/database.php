<?php

// Configuración para producción (Render) y desarrollo local
// Usa getenv() que funciona mejor en diferentes entornos
return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'dbname' => getenv('DB_NAME') ?: 'academias',
    'username' => getenv('DB_USER') ?: 'academias_54hx_user',
    'password' => getenv('DB_PASSWORD') ?: 'Dh0RypGxzkckl3tkcGEwtdJKkxj7D1Kp',
    'port' => getenv('DB_PORT') ?: 5432
];

