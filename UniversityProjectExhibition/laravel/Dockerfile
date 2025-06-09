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

# Override the default Apache site config
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html


#if error, remove this two lines # 1
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader 



# Copy project files into the container
COPY . .

# Ensure .env file exists (important for Laravel install) --now close this
#RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Install PHP dependencies with Composer (includes script hooks)
#RUN composer install --no-interaction --optimize-autoloader --no-dev ----------if i get error, remove the # 1

# Generate Laravel app key
RUN php artisan key:generate

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
