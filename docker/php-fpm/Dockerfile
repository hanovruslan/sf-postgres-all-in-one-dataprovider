FROM php:7.1-fpm

RUN apt update && \
    apt install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

ARG APP_PATH=/usr/share/symfony

WORKDIR ${APP_PATH}

COPY ./src ./
