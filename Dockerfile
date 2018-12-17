FROM php:apache

RUN apt-get update && apt-get -y install libyaml-dev && apt-get clean

RUN pecl install yaml && a2enmod rewrite && a2enmod headers && docker-php-ext-enable yaml

COPY /Docker/apache.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/
