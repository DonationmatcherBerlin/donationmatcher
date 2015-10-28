#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install -y git curl php5-cli php5-curl php5-mcrypt php5-gd php5-fpm

### From Installing MySQL

sudo debconf-set-selections <<< 'mysql-server \
 mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server \
 mysql-server/root_password_again password root'
sudo apt-get install -y php5-mysql mysql-server mysql-client

sudo service mysql restart

mysql -uroot -proot -e "CREATE DATABASE donationmatcher CHARACTER SET utf8 COLLATE utf8_general_ci; GRANT ALL ON donationmatcher.* TO 'donationmatcher'@'%' IDENTIFIED BY 'donationmatcher';"

### From Installing nginx

sudo apt-get install -y nginx

/bin/cat <<EOM > /etc/nginx/sites-available/default
server {
  listen 80;
  root /var/www/public;
  index index.php;
  location / {
    try_files \$uri /index.php\$is_args\$args;
  }
  location ~ ^/index\.php(/|$) {
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_split_path_info ^(.+\.php)(/.*)$;
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
    fastcgi_param DOCUMENT_ROOT \$realpath_root;
    #fastcgi_param HTTPS on;
    #fastcgi_param CI_ENV production;
    internal;
  }
}
EOM

sudo service nginx restart

# composer
cd /var/www
curl -sS 'https://getcomposer.org/installer' | php
php composer.phar install

echo "You've been provisioned"