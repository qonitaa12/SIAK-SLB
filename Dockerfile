# ===============================
# STEP 1: Base PHP + System Setup
# ===============================
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    zip \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    npm \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath gd

# Install Node.js 18.x
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# ===============================
# STEP 2: Build Dependencies
# ===============================
# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Install JavaScript dependencies
RUN npm install && npm run build

# ===============================
# STEP 3: Set Permissions
# ===============================
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ===============================
# STEP 4: Copy start.sh & expose port
# ===============================
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8000

# ===============================
# STEP 5: Run Application
# ===============================
CMD ["sh", "/start.sh"]
