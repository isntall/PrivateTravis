#!/bin/bash

# Ensure we have a "drupal" user and database.
/usr/bin/mysqld_safe &
sleep 10s
mysql -uroot -proot -e "GRANT ALL ON *.* TO root@'%' IDENTIFIED BY 'root';";
mysql -uroot -proot -e "FLUSH PRIVILEGES"
killall mysqld
sleep 10s

