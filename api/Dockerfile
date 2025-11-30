FROM php:8.1-apache

# Install mysqli extension for MySQL connection
RUN docker-php-ext-install mysqli

# Copy application code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html