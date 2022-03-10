FROM php:8.0-apache

# Add user for application

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/

WORKDIR /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www-data

RUN composer install

EXPOSE 80

