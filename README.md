# donationmatcher

TODO description

## Install

vagrant:
```
sudo apt-get install virtualbox
sudo apt-get install vagrant
```

run:
```
vagrant up
```
This will download and setup the VM.

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