FROM php:8.0
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json
RUN apt-get update -y && apt-get install -y openssl zip unzip git libonig-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo
WORKDIR /app
COPY . /app


