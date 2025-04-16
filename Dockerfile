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
    # netcat-openbsd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


# Set working directory
WORKDIR /app

# Copy entire Laravel project
COPY . /app

# Copy .env (Optional for local dev; comment out if using Railway ENV vars)
# UNCOMMENT this line for local builds if you have a .env file
# COPY .env /app/.env

# # Copy wait script & make it executable
# COPY wait-for-mysql.sh /usr/local/bin/wait-for-mysql.sh
# RUN chmod +x /usr/local/bin/wait-for-mysql.sh


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create storage link
RUN php artisan storage:link

# Expose port
EXPOSE 8080

# Runtime commands (config caching & server start)
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT} 
    
