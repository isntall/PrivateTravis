#!/bin/bash

# Enable tmpfs here.
mkdir /tmp/ramdisk
mount -t tmpfs -o size=256M tmpfs /tmp/ramdisk/
 
# Move MySQL data
mv /var/lib/mysql /tmp/ramdisk/mysql
ln -s /tmp/ramdisk/mysql/ /var/lib/mysql
 
# Update permissions
chmod -R 700 /var/lib/mysql
chown -R mysql:mysql /var/lib/mysql

mysqld_safe
