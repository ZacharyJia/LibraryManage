FROM daocloud.io/php:5.6-apache

RUn apt-get update
RUN apt-get install -y libmcrypt-dev libssl-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring 
RUN docker-php-ext-install mcrypt 
RUN docker-php-ext-install tokenizer 

RUN docker-php-ext-configure openssl
RUN docker-php-ext-install openssl


COPY src/ /var/www/html/
