FROM php:8.2-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl zip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_pgsql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install frontend dependencies + build Vue
RUN npm install
RUN npm run build

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# ⚠️ IMPORTANT: expose Render port
EXPOSE 10000

# 🚀 الأفضل: run migrate + start server safely
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000