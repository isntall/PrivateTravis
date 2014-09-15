# -*- mode: ruby -*-
# vi: set ft=ruby :

##
# Variables.
##

box      = 'precise64'
url      = 'http://files.vagrantup.com/' + box + '.box'
hostname = 'pt'
domain   = 'dev'
cpus     = '2'
ram      = '2048'

##
# Configuration.
##

Vagrant.configure("2") do |config|
  config.vm.box      = box
  config.vm.hostname = hostname + '.' + domain
  config.vm.box_url  = url

  if Vagrant.has_plugin?('vagrant-auto_network')
    # Network configured as per bit.ly/1e0ZU1r
    config.vm.network :private_network, :ip => "0.0.0.0", :auto_network => true
  else
    config.vm.network :private_network, :ip => "192.168.50.10"
  end

  config.vm.synced_folder ".", "/vagrant"

  # Virtualbox provider configuration.
  config.vm.provider :virtualbox do |vb|
    vb.customize ["modifyvm",     :id, "--cpus", cpus]
    vb.customize ["modifyvm",     :id, "--memory", ram]
    vb.customize ["modifyvm",     :id, "--natdnshostresolver1", "on"]
    vb.customize ["modifyvm",     :id, "--natdnsproxy1", "on"]
    vb.customize ["modifyvm",     :id, "--nicpromisc1", "allow-all"]
    vb.customize ["modifyvm",     :id, "--nicpromisc2", "allow-all"]
    vb.customize ["modifyvm",     :id, "--nictype1", "Am79C973"]
    vb.customize ["modifyvm",     :id, "--nictype2", "Am79C973"]
    vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end

  # We reuse the packer script since they are available to us.
  # This is a good way to test them out.
  config.vm.provision :shell, :path => "packer/ubuntu/scripts/base.sh"
  config.vm.provision :shell, :path => "packer/ubuntu/scripts/sshd.sh"
  config.vm.provision :shell, :path => "packer/ubuntu/scripts/compiler.sh"
  config.vm.provision :shell, :path => "packer/ubuntu/scripts/docker.sh"
  config.vm.provision :shell, :path => "packer/ubuntu/scripts/containers.sh"

end
