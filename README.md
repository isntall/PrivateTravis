Docker Drupal
=============

### Overview

Base containers that are used for a Drupal Travis CI knockoff.

![Diagram](./docs/diagram.png "docs/diagram.png")

### Containers

All the containers that are provided for this CI can be found here:

[Link to container docs](containers/README.md)

### The compiler

While our containers do run the TravisCI configuration file. They only run the
build "script" instructions. It's up to us to:

* Build all the permutations eg. PHP 5.5 + Mysql and PHP 5.4 and Postgres
* Links containers.

This is where the following compiler comes into play. Here is an example of the
command that you can run to compile the .travis.yml file into the many
permutations.

[Link to Compiler docs](compiler/README.md)

### Vagrant

Vagrant is very handy. If you do not run Docker natively the following VM will
provide a method for debugging and building and executing of containers locally.

Install Vagrant (1.6.x):

```
http://www.vagrantup.com/downloads.html
```

Spin up a VM with Docker with the following command:

```
vagrant up
```

### Things still to be done.

Please see the issue page for a list of tasks we still need to do.
