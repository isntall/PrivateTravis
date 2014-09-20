#!/bin/bash -eux

# Name:        containers.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Pull down the containers required for a build via the make command.

# Go to the container subproject.
git clone https://github.com/nickschuch/PrivateTravisContainers.git /root/PrivateTravis /root/PrivateTravisContainers
cd /root/PrivateTravisContainers

make pull
