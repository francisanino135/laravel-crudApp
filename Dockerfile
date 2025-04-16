# Use official PHP image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip curl git npm nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /app

# Copy entire Laravel project into the container
COPY . /app

# Copy .env (optional)
COPY .env /app/.env

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Cache Laravel configs
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Expose port
EXPOSE 8000

# Start Laravel dev server
CMD php artisan serve --host=0.0.0.0 --port=$PORT
