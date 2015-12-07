#!/bin/bash
rm -r /var/www/html

cd /var/www
ln -s libsystem/public/ html
