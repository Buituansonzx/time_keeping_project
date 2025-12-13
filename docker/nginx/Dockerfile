ARG NGINX_VERSION=1.25-alpine
FROM nginx:${NGINX_VERSION}

# Copy nginx config
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Set working directory
WORKDIR /var/www/html

# Expose port
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]