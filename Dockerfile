FROM php:8.2-apache as base

ENV TZ=Europe/Budapest

RUN apt-get update && apt-get install -y git wget libpq-dev libzip-dev
RUN docker-php-ext-install pdo pgsql zip

RUN a2enmod rewrite
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/project

FROM base as production

ENV APP_ENV=prod
ENV COMPOSER_ALLOW_SUPERUSER=1

# install composer
COPY --from=composer/composer:2-bin /composer /usr/bin/composer


COPY . .
RUN composer install --no-interaction --no-dev
RUN composer dump-env prod

EXPOSE 80
ENTRYPOINT ["apache2ctl", "-D", "FOREGROUND"]