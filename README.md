# API de Mantenimiento de Profesores

API REST para el mantenimiento (CRUD) de profesores.

## Endpoints

- **GET** `/api/profesores` - Listar todos los profesores
- **GET** `/api/profesores/{id}` - Obtener un profesor por ID
- **POST** `/api/profesores` - Crear un nuevo profesor
- **PUT** `/api/profesores/{id}` - Actualizar un profesor
- **DELETE** `/api/profesores/{id}` - Eliminar un profesor

## Despliegue en Render

### 1. Crear Base de Datos PostgreSQL en Render

1. Ve a [Render Dashboard](https://dashboard.render.com)
2. Click en "New +" → "PostgreSQL"
3. Configura:
   - Name: `api-profesores-db`
   - Database: `academias`
   - User: `postgres` (o el que prefieras)
   - Region: Elige la más cercana
4. Guarda las credenciales que te da Render

### 2. Crear Web Service en Render

1. Conecta tu repositorio de GitHub/GitLab
2. Render detectará automáticamente que es PHP
3. Configura:
   - **Name**: `api-profesores`
   - **Environment**: `PHP`
   - **Build Command**: `composer install --no-dev --optimize-autoloader`
   - **Start Command**: `php -S 0.0.0.0:$PORT -t .`

### 3. Configurar Variables de Entorno

En el dashboard de Render, ve a tu servicio → Environment y agrega:

```
DB_HOST=tu-host-de-render.postgres.render.com
DB_NAME=academias
DB_USER=postgres
DB_PASSWORD=tu-password-de-render
DB_PORT=5432
```

### 4. Crear la Tabla en PostgreSQL

Ejecuta este SQL en la base de datos de Render:

```sql
CREATE TABLE profesores (
    id SERIAL PRIMARY KEY,
    curso VARCHAR(255) DEFAULT NULL,
    anio_experiencia INTEGER DEFAULT NULL,
    dni CHAR(8) NOT NULL,
    nombre VARCHAR(255) DEFAULT NULL,
    apellidos VARCHAR(255) DEFAULT NULL,
    foto VARCHAR(255) DEFAULT NULL
);
```

## Desarrollo Local

1. Instala dependencias:
```bash
composer install
```

2. Configura `.env` o edita `config/database.php` directamente

3. Levanta el servidor:
```bash
php -S localhost:8000
```

## Estructura del Proyecto

```
├── config/
│   └── database.php      # Configuración de BD
├── controllers/
│   └── ProfesorController.php
├── database/
│   └── Database.php      # Clase de conexión
├── models/
│   └── Profesor.php      # Modelo CRUD
├── index.php             # Punto de entrada
└── composer.json
```

