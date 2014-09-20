#!/bin/bash -eux

# Name:        command.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Install PrivateTravis to the host.

# Go to the PrivateTravis project.
git clone https://github.com/nickschuch/PrivateTravis.git /root/PrivateTravis /root/PrivateTravis
cd /root/PrivateTravis

# We need to do this so we can build the .phar for PrivateTravis.
echo "phar.readonly = Off" >> /etc/php5/cli/php.ini

# Run the test suite and generate a .phar file.
phing
mv bin/PrivateTravis.phar /usr/local/bin/PrivateTravis
chmod 775 /usr/local/bin/PrivateTravis
