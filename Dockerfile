FROM daocloud.io/php:5.6-apache

RUn apt-get update
RUN apt-get install -y libmcrypt-dev libssl-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring 
RUN docker-php-ext-install mcrypt 
RUN docker-php-ext-install tokenizer 

RUN cp /usr/src/php/ext/openssl/config0.m4 /usr/src/php/ext/openssl/config.m4
RUN docker-php-ext-install openssl

RUN cp /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/

COPY src/ /var/www/html/

RUN cd /var/www/ && chmod -R 777 html
