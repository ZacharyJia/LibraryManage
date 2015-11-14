FROM daocloud.io/php:5.6-apache

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring

COPY src/ /var/www/html/
