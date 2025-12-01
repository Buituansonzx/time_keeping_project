ARG NGINX_VERSION=alpine
FROM nginx:${NGINX_VERSION}

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html