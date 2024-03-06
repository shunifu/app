ARG ver=7.4
FROM php:$ver-cli
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json
RUN set -ex ; \
    apt-get update ; \
    apt-get install -y git zip ; \
    composer -n validate --strict ; \
    composer -n install --no-scripts --ignore-platform-reqs --no-dev

ARG ver=7.4
FROM php:$ver-apache
RUN set -ex ; \
    docker-php-ext-install pdo_mysql mysqli ; \
    a2enmod rewrite
COPY --from=0 vendor vendor
