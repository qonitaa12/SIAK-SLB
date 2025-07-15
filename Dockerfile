FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libpq-dev \
    npm \
    nodejs \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www

# Copy composer and install dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy .env if needed
# COPY .env.example .env

# Generate app key (you could also do this via env var)
RUN php artisan key:generate

# Set correct permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port
EXPOSE 8000

# Start Laravel development server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
