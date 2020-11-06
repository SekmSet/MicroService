FROM php:7.4-cli

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

RUN apt update && apt install git zip -y

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install
CMD php -S 0.0.0.0:8080 -t public
