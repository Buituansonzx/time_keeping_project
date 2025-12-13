#!/bin/bash
set -e

echo "🚀 Starting PHP-FPM..."

# Tạo các thư mục Laravel cần thiết
mkdir -p storage/framework/{sessions,views,cache} storage/logs bootstrap/cache

# Đặt permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache || true

# Tạo APP_KEY nếu chưa có
if ! grep -q "^APP_KEY=" .env || grep -q "^APP_KEY=$" .env; then
    php artisan key:generate --force
fi

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Start PHP-FPM
exec php-fpm -F
