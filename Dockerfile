FROM php:8.4-apache

# Update the port configuration in the Apache config file
RUN sed -i 's/80/8877/g' /etc/apache2/sites-available/000-default.conf

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql

# Copy the Laravel project into the container
COPY . /var/www/html

# Set correct permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 8877

CMD ["apache2-foreground"]
