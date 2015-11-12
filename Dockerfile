FROM ubuntu:14.04
MAINTAINER Zachary Jia <jia199474@gmail.com>

RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get -y upgrade

RUN apt-get -y install apache2
RUN apt-get -y install php5

EXPOSE 80