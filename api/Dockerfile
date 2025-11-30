FROM php:8.1-apache

# Install mysqli extension for MySQL connection
RUN docker-php-ext-install mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable mod_rewrite
RUN a2enmod rewrite

# Create Apache configuration for the application
RUN echo '<Directory /var/www/html>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>' > /etc/apache2/conf-available/app.conf && \
    a2enconf app

# Copy application code and composer files
COPY . /var/www/html/
WORKDIR /var/www/html

# Install PHP dependencies (both prod and dev for testing in container)
RUN composer install --no-interaction --prefer-dist

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html
