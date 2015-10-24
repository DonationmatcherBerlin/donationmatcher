Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.box_url = "https://cloud-images.ubuntu.com/vagrant/trusty/20151021/trusty-server-cloudimg-amd64-vagrant-disk1.box"

  config.vm.network "private_network", ip: "192.168.50.4"
  config.vm.network "forwarded_port", guest: 80, host: 8080

  config.vm.synced_folder "./", "/var/www", id: "webroot", owner: "www-data", group: "www-data"

  config.vm.provider :virtualbox do |virtualbox|
    virtualbox.customize ["modifyvm", :id, "--name", "donationmatcher"]
    virtualbox.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    virtualbox.customize ["modifyvm", :id, "--memory", "512"]
    virtualbox.customize ["setextradata", :id, "--VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end

  config.vm.provision :shell, :path => "provision.sh"

  config.ssh.keep_alive = true
  config.ssh.forward_agent = false
  config.ssh.forward_x11 = false
  config.vagrant.host = :detect
end
