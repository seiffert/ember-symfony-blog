# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "puppetlabs/ubuntu-14.04-64-puppet"

  config.vm.network "private_network", ip: "192.168.10.123"

  config.ssh.forward_agent = true

  config.vm.synced_folder ".", "/opt/blog"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision :shell, :inline => 'apt-get update;'

  config.librarian_puppet.puppetfile_dir = "provisioning/vendor"
  config.librarian_puppet.placeholder_filename = ".gitkeep"

  config.vm.provision "puppet" do |puppet|
    puppet.manifests_path = "provisioning"
    puppet.manifest_file  = "dev.pp"
    puppet.module_path = ["provisioning/modules", "provisioning/vendor/modules"]
  end
end
