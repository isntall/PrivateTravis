Docker Drupal
=============

### Overview

Base containers that are used for a Drupal Travis CI knockoff.

![Diagram](./docs/diagram.png "docs/diagram.png")

### Containers

#### Base

This container is responsible for providing all the base packages including:

* PHP-CLI
* PHPENV
* Composer
* Travis command line utility

#### PHP 5.4

Provides PHP 5.4 for Travis runs. Yep, that's about it.

#### PHP 5.5

Provides PHP 5.5 for Travis runs. Yep, that's about it.

#### Installation

We have a simple Makefile in this repository to help with building the
containers. This project requires you have the "make" package installed.

```
eg. apt-get install -y make

```

On a Docker based host run the following command:

```
make build
```

### The compiler

While our containers do run the TravisCI configuration file. They only run the
build "script" instructions. It's up to us to:

* Build all the permutations eg. PHP 5.5 + Mysql and PHP 5.4 and Postgres
* Links containers.

This is where the following compiler comes into play. Here is an example of the
command that you can run to compile the .travis.yml file into the many
permutations.

**Basic**:

The very basic command with standard containers.

```
compiler build
```

**Namespace**:

To override the provider of the containers. A good example of this would be if
you had your own custom containers for testing and/or personal testing.

```
compiler build --namespace="drupal"
```

**Commands**:

This will allow you to define your own custom command groups that will get
loaded from the YAML file.

```
compiler build env before_script script
```

**YAML**:

This allows for a different file to be loaded from the project.

```
compiler build --file=".othername.yml"
```

#### Installation

We use composer to pull down the applications dependencies. Run the following
command to get setup:

```
cd compiler && composer install --prefer-dist
```

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
