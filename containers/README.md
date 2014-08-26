Containers
==========

#### Base

Provides base packages.

[Read more here](base)

#### PHPENV

Provides all packages used for builds:

* PHP-CLI
* PHPENV
* Composer
* Travis command line utility

[Read more here](phpenv)

#### PHP5.4

[Read more here](php5.4)

#### PHP5.5

[Read more here](php5.5)

#### Mysql

This Docker container provides a basic Mysql service for DrupalCI.

[Read more here](mysql)

#### Postgres

This Docker container provides a basic Postgres service for DrupalCI.

[Read more here](postgres)

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
