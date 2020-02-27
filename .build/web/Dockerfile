FROM php:7.2-apache

# Install packages
RUN apt-get update && apt-get install -y vim git zip unzip libcurl4-openssl-dev pkg-config libssl-dev gnupg

# Enable Apache modules
RUN a2enmod rewrite

# Install composer
#RUN curl -sS https://getcomposer.org/installer | php
#RUN mv composer.phar /usr/local/bin/composer
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Install dependencies
#RUN cd /var/www/html && composer install && composer dumpautoload
