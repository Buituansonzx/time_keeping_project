#!/bin/sh
set -e

# Generate php.ini và Nginx config từ env
envsubst < /usr/local/etc/php/conf.d/custom.ini > /usr/local/etc/php/conf.d/php.ini
envsubst < /etc/nginx/conf.d/default.conf > /etc/nginx/conf.d/default.conf.generated
mv /etc/nginx/conf.d/default.conf.generated /etc/nginx/conf.d/default.conf

# Tạo .env Laravel nếu chưa có
if [ ! -f ${APP_CODE_PATH_CONTAINER}/.env ]; then
    cp ${APP_CODE_PATH_CONTAINER}/.env.example ${APP_CODE_PATH_CONTAINER}/.env
fi

# Chạy composer install nếu chưa có vendor
if [ ! -d ${APP_CODE_PATH_CONTAINER}/vendor ]; then
    composer install --no-interaction --optimize-autoloader
fi

exec "$@"
