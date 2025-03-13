# Usa una imagen base oficial de PHP
FROM php:7.4-apache

# Copia los archivos de tu proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto 80 para el servidor web
EXPOSE 80