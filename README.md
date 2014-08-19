Docker Drupal
=============

### Overview

Base containers that are used for a Drupal Travis CI knockoff.

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

Provides PHP 5.4 for Travis runs. Yep, that's about it.

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
build instructions. It's up to us to:

* All the permutations.
* Links containers.

With this in mind I created a little symphony console application that will take
the TravisCI configuration file and return a script that we can use to test.

#### Installation

We use composer to pull down the applications dependencies. Run the following
command to get setup:

```
cd compiler && composer install --prefer-dist
```
