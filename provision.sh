#!/usr/bin/env bash

sudo apt-get update
sudo apt-get install -y git curl php5-cli php5-curl php5-mcrypt php5-gd php5-fpm

### From Installing MySQL

sudo debconf-set-selections <<< 'mysql-server \
 mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server \
 mysql-server/root_password_again password root'
sudo apt-get install -y php5-mysql mysql-server

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
    try_files \$uri \$uri/ /index.php;
  }
  # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
  location ~ \.php$ {
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
    include fastcgi_params;
  }
}
EOM

sudo service nginx restart

echo "You've been provisioned"