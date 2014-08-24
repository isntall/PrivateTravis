Containers
==========

#### PHPENV

This container is responsible for providing all the base packages including:

* PHP-CLI
* PHPENV
* Composer
* Travis command line utility

#### PHP5.4

Provides PHP 5.4 for Travis runs. Yep, that's about it.

#### PHP5.5

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
