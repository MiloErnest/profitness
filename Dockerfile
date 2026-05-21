# pro.fitness — imagen de producción para Render (Web Service)
# Build: assets Vite + dependencias PHP; runtime: PHP 8.2 + artisan serve

FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json ./
RUN npm install
COPY vite.config.js ./
COPY resources ./resources
RUN npm run build

FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs
COPY . .
RUN composer install --no-dev --optimize-autoloader --no-scripts

FROM php:8.2-cli-alpine AS runtime
RUN apk add --no-cache postgresql-dev libzip-dev \
    && docker-php-ext-install pdo_pgsql zip opcache

WORKDIR /var/www/html
COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache || true

ENV PORT=8000
EXPOSE 8000
ENTRYPOINT ["/entrypoint.sh"]
