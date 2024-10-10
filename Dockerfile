# Utilizar la imagen base de PHP con Apache
FROM php:7.4-apache

# Instalar las dependencias necesarias para curl
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install curl

# Copiar el código de la aplicación al directorio root del servidor
COPY ./src /var/www/html/

# Instalar la extensión de PHP para poder realizar peticiones HTTP (curl)
RUN docker-php-ext-install curl
