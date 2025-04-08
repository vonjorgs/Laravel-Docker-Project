# Dockerfile
FROM php:8.3-fpm 

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nodejs \
    npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application
COPY . .

# Install Laravel dependencies
RUN composer install

# Install Node.js dependencies (for Vite/Assets)
RUN npm install

# Permissions (optional if needed)
RUN chown -R www-data:www-data /var/www

EXPOSE 9000 8000

# Set entrypoint: Start Laravel development server and PHP-FPM
CMD bash -c "php artisan serve --host=0.0.0.0 --port=8000 & php-fpm"
