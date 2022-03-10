FROM php:8.0-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    zip \
    unzip \
    git \
    curl
# Install dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql && a2enmod rewrite

# Copy project
COPY . /var/www/html/

# Change permission
RUN chown -R www-data:www-data /var/www/

# Change working directory
WORKDIR /var/www/html/

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# change user to apache user
USER www-data

# Install composer dependencies
RUN composer install

# Expose port 80
EXPOSE 80

