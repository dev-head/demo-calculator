Demo Task :: Calculator
======================

Just a demo app that is used to test a rpn calculation via cli. If you have php7 installed already you really don't need the VM; if you have an older version use Varant installation below to run inside a VM.

@todo 
------
- test more complex expressions
- add box and maintain a deployable phar 
- move Calculator to it's own repository 
- expand support for other expression notations


Virtual Machine Installation 
----------------------------

### Development Dependencies

- [Virtual Box](https://www.virtualbox.org/wiki/Downloads)
- [Vagrant](https://www.vagrantup.com/downloads.html)

### Development VM Configuration
There are two configuration files, the default and local. Local should not be checked in should be used to override any of the project default configurations or add new ones. 

#### Create New Config to modify
```
cp config/vagrant.local.json.example config/vagrant.local.json
```

----

### VM Access

#### Start / SSH / Stop / Destroy / Provision the VM

```
vagrant up
vagrant ssh
vagrant halt
vagrant destroy
vagrant provision
```

----

### Install PHP Dependencies

#### Get latest composer version
```
./composer self-update
```

#### Install latest dependencies
```
./composer update
```

----

Use
---

#### Run calculation task, passing the rpn expression in quotes for portability. 
```
php bin/console calc "1 1 +"
```

Testing
-------

- [Peridot](http://peridot-php.github.io/)

```
./vendor/bin/peridot tests/calculator/Calculator.spec.php
```




