FROM ubuntu:14.04
MAINTAINER Zachary Jia <jia199474@gmail.com>

RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get -y upgrade

RUN apt-get -y install apache2 php5 zip curl

RUN curl -o /var/www/html/master.zip -L https://codeload.github.com/ZacharyJia/LibraryManage/zip/master
RUN cd /var/www/html/ && unzip master.zip && mv LibraryManage-master/* . && rm -rf LibraryManage-master master.zip

EXPOSE 80