# donationmatcher

TODO description

## Install

Install [VirtualBox](https://www.virtualbox.org/) and [Vagrant ](https://www.vagrantup.com/)

run `vagrant up` in directory of this file to download and setup the VM.

go to http://192.168.50.4/

## Install database and dummy data

Login to VM with `vagrant ssh`

```
cd /var/www
curl http://localhost/migrate
mysql -uroot -proot donationmatcher < dummies.sql
```

## URLS

**user profile**: http://192.168.50.4/user/profile

**stock list**: http://192.168.50.4/stockList/get

**match**: http://192.168.50.4/local/match