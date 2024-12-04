FROM php:8.1-apache

# Instalacja wymaganych rozszerzeń PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Włączenie mod_rewrite w Apache
RUN a2enmod rewrite

# Skopiowanie plików aplikacji do obrazu
COPY ./src /var/www/html

# Ustawienie praw dostępu
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
