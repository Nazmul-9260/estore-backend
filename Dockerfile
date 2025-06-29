# Step 1: PHP 8.2 FPM ইমেজ থেকে শুরু
FROM php:8.2-fpm


# Set working directory
WORKDIR /var/www



# Step 2: System dependencies ইনস্টল করুন (যা Laravel ও Composer এর জন্য দরকার)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    netcat-openbsd \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Step 3: PHP এক্সটেনশন ইনস্টল করুন
RUN docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath xml gd

# Step 4: Composer ইনস্টল করুন (অফিশিয়াল Composer ইমেজ থেকে কপি)
# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www

# Set correct permissions
RUN chown -R www-data:www-data /var/www

# Set Laravel permissions for storage and cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy and set up the entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Install PHP dependencies and optimize autoloader
RUN composer install --optimize-autoloader --no-interaction
# Expose PHP-FPM port
EXPOSE 9000

# Use custom entrypoint script
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]

# Start PHP-FPM as the main process
CMD ["php-fpm"]

