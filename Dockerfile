# Step 1: Use PHP with Apache
FROM php:7.4-apache

# Step 2: Install required PHP extensions (CodeIgniter needs MySQL, PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Step 3: Enable Apache mod_rewrite (needed for CodeIgniter routes)
RUN a2enmod rewrite

# Step 4: Copy project files into Apache web root
COPY . /var/www/html/

# Step 5: Set working directory
WORKDIR /var/www/html

# Step 6: Fix permissions (so Apache can read/write files)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Step 7: Expose port 80 (HTTP)
EXPOSE 80

# Step 8: Start Apache server
CMD ["apache2-foreground"]
