#!/bin/bash -eux

# Name:        docker.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Installs Docker.

curl -sSL https://get.docker.io/ubuntu/ | sudo sh

# We also need to add the "ubuntu" user to the docker group so it can run
# containers.
usermod -a -G docker ubuntu
