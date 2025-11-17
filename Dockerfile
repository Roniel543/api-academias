FROM php:8.2-apache

# Instalar extensiones de PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Configurar Apache para usar index.php
RUN echo '<Directory /var/www/html>' > /etc/apache2/conf-available/docker-php.conf \
    && echo '  Options Indexes FollowSymLinks' >> /etc/apache2/conf-available/docker-php.conf \
    && echo '  AllowOverride All' >> /etc/apache2/conf-available/docker-php.conf \
    && echo '  Require all granted' >> /etc/apache2/conf-available/docker-php.conf \
    && echo '</Directory>' >> /etc/apache2/conf-available/docker-php.conf \
    && a2enconf docker-php

EXPOSE 80

CMD ["apache2-foreground"]

