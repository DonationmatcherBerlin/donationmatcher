## Install

Install [VirtualBox](https://www.virtualbox.org/) and [Vagrant](https://www.vagrantup.com/)

run `vagrant up` to download and setup the VM.

### Install database and dummy data

Login to VM with `vagrant ssh`

```
cd /var/www
curl http://localhost/migrate
mysql -uroot -proot donationmatcher < dummies.sql
```

go to http://192.168.50.4/

## Users

Password is always: `test`
 
### Normal users

```
admin
user1
user2
user3
```
 
### Technical users

```
admin111 - confirmed + deleted
user011  - confirmed + deleted
user000  - not confirmed
user001  - not confirmed + deleted
```

