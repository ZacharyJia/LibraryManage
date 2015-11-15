FROM ganiutomo/docker-php-laravel:latest
MAINTAINER Zachary Jia "jia199474@gmail.com"

ENV DEBIAN_FRONTEND noninteractive

EXPOSE 80

COPY src/ /var/www/html/
