#!/bin/bash -eux

# Name:        base.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Install base packages and configuration.

# Packages.
apt-get -y update
apt-get -y install curl wget git vim make php-pear php5-dev php5-curl default-jre

# Composer.
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer && chmod +x /usr/local/bin/composer

# Phing.
pear channel-discover pear.phing.info
pear install phing/phing-2.6.1

# This project.
git clone https://github.com/nickschuch/docker-drupal.git /root/docker-drupal

apt-get clean
