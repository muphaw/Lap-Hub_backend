# Use official PHP 8.2 with Apache base image
FROM php:8.2-apache

# Install system dependencies and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql

# Enable Apache mod_rewrite for Laravel pretty URLs
RUN a2enmod rewrite

# Set Apache document root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Override the default Apache site config to use new document root
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory inside the container to /var/www/html
WORKDIR /var/www/html

# Copy Laravel project files from the 'laravel' directory on host to container
COPY . .

# Install PHP dependencies with Composer (no dev for production)
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

# Run Laravel post-install scripts (optional, if you want them)
RUN composer run-script post-install-cmd

# Fix permissions for storage and cache so Apache can write to them
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose HTTP port 80
EXPOSE 80

# Start Apache in foreground mode
CMD ["apache2-foreground"]
