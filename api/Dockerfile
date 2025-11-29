FROM php:8.1-apache

# Install mysqli extension for MySQL connection
RUN docker-php-ext-install mysqli

# Enable mod_rewrite
RUN a2enmod rewrite

# Create Apache configuration for the application
RUN echo '<Directory /var/www/html>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>' > /etc/apache2/conf-available/app.conf && \
    a2enconf app

# Copy application code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html
