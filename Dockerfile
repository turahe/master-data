ARG PHP_VERSION=8.4
FROM php:${PHP_VERSION}-cli

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libonig-dev \
        libpq-dev \
        libsqlite3-dev \
        libxml2-dev \
    && for extension in dom mbstring pdo_mysql pdo_pgsql pdo_sqlite xml; do \
        if ! php -m | grep -qi "^${extension}$"; then docker-php-ext-install "$extension"; fi; \
    done \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY . .

RUN composer install --no-interaction --prefer-dist --no-progress

CMD ["vendor/bin/phpunit"]