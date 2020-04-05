FROM php:7.1-fpm

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# Set the timezone
ARG TZ=America/Belem
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# make sure apt is up to date
RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN docker-php-ext-install sockets
RUN docker-php-ext-install pdo
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install json

RUN apt install -y libc-client-dev
RUN apt install -y libkrb5-dev
RUN apt install -y curl
RUN apt install -y libcurl3-dev
RUN  docker-php-ext-install curl

# Copy the php-fpm config
#COPY ./docker/php/dockerhero.fpm.conf /usr/local/etc/php-fpm.d/zzz-dockerhero.fpm.conf
COPY ./docker/php/dockerhero.php.ini /usr/local/etc/php/conf.d/dockerhero.php.ini

WORKDIR /var/www

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN usermod -u 1000 www-data
