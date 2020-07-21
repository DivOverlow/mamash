FROM php:7.2-apache

# Install apt-transport-https
RUN apt-get update && apt-get install -y apt-transport-https

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions
RUN apt-get update && apt-get install -y zlib1g-dev libpng-dev
RUN docker-php-ext-install pdo pdo_mysql zip sockets gd
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-install intl

# Install memcached php extension
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev \
    && pecl install memcached-3.0.3 \
    && docker-php-ext-enable memcached

# Install ClamAV
RUN apt-get update && apt-get install -y clamav clamav-freshclam clamav-daemon

# Install nodejs
RUN apt-get install -y software-properties-common
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -
RUN apt-get install -y nodejs

WORKDIR "/var/www/html"