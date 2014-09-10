#!/bin/bash -eux

# Name:        base.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Install base packages and configuration.

apt-get -y update
apt-get -y upgrade
apt-get -y install curl wget git vim make
apt-get clean
