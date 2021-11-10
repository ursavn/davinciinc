# Set master image
FROM composer as composer
COPY . /app
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:7.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory
COPY . .
COPY --from=composer /app/vendor /var/www/html/vendor