FROM php:8.2-apache

# Включаем mod_rewrite, если нужно
RUN a2enmod rewrite

# Копируем PHP-файлы в папку сайта
COPY handler.php /var/www/html/index.php

# Устанавливаем права
RUN chown -R www-data:www-data /var/www/html

# Открываем 80 порт
EXPOSE 80
