#!/bin/bash

# Đợi MySQL sẵn sàng
echo "Waiting for MySQL to be ready..."
while ! mysqladmin ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
    sleep 1
done
echo "MySQL is ready!"

# Kiểm tra file .env có tồn tại không
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env file..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Cập nhật .env từ environment variables
echo "Updating .env configuration..."

sed -i "s/DB_HOST=.*/DB_HOST=${DB_HOST}/" /var/www/html/.env
sed -i "s/DB_PORT=.*/DB_PORT=${DB_PORT}/" /var/www/html/.env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" /var/www/html/.env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /var/www/html/.env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" /var/www/html/.env

sed -i "s/REDIS_HOST=.*/REDIS_HOST=${REDIS_HOST}/" /var/www/html/.env
sed -i "s/REDIS_PORT=.*/REDIS_PORT=${REDIS_PORT}/" /var/www/html/.env

sed -i "s|APP_URL=.*|APP_URL=${APP_URL}|" /var/www/html/.env
sed -i "s|API_URL=.*|API_URL=${API_URL}|" /var/www/html/.env

# Generate key nếu chưa có
if grep -q "APP_KEY=$" /var/www/html/.env || grep -q "APP_KEY=base64:$" /var/www/html/.env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Clear cache
echo "Clearing cache..."
php artisan config:clear
php artisan cache:clear

# Set permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Starting PHP-FPM..."
exec php-fpm