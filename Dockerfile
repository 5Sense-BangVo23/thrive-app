FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY src/ /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files
COPY src/composer.json /var/www/html/composer.json
COPY src/composer.lock /var/www/html/composer.lock

# Update Composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer self-update

# Install dependencies using Composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer update --no-interaction

# Set permissions for storage and bootstrap/cache
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Define the command to run the application
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
