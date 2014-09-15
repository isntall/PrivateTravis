Containers
==========

### Overview

The following containers are used for PrivateTravis builds.

### Containers

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

#### PHP5.3

[Read more here](php5.3)

#### PHP5.4

[Read more here](php5.4)

#### PHP5.5

[Read more here](php5.5)

#### PHP5.6

[Read more here](php5.6)

#### Mysql

This Docker container provides a basic Mysql service.

[Read more here](mysql)

#### Postgres

This Docker container provides a basic Postgres service.

[Read more here](postgres)

### Installation

We have a simple Makefile in this repository to help with building the
containers. This project requires you have the "make" package installed.

```
eg. apt-get install -y make

```

On a Docker based host run the following command:

```
make build
```

### Test coverage

We use http://serverspec.org to ensure that container are built with the correct
configuration.

**These tests run at "build".**
