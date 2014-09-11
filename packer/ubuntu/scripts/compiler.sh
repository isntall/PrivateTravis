#!/bin/bash

# Name:        compiler.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Install the compiler to the host.

# Go to the compiler subproject.
cd /root/docker-drupal/compiler

# Run the test suite and generate a .phar file.
phing
mv bin/compiler.phar /usr/local/bin/compiler
chmod 775 /usr/local/bin/compiler
