FROM ganiutomo/docker-php-laravel:latest
MAINTAINER Zachary Jia "jia199474@gmail.com"

EXPOSE 80

COPY src/ /var/www/html/
