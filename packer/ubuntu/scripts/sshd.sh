#!/bin/bash -eux

# Name:        sshd.sh
# Author:      Nick Schuch (nick@myschuch.com)
# Description: Configure SSH.

echo "UseDNS no" >> /etc/ssh/sshd_config
