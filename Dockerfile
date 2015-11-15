FROM daocloud.io/php:5.6-apache

RUn apt-get update
RUN apt-get install -y libapache2-mod-php5
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring 
RUN docker-php-ext-install tokenizer 

COPY src/ /var/www/html/
