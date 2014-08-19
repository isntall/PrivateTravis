Docker Drupal
=============

## Overview

Base containers that are used for a Drupal Travis CI knockoff.

## Containers

### Base

This container is responsible for providing all the base packages including:

* PHP-CLI
* PHPENV
* Composer
* Travis command line utility

### PHP 5.4

Provides PHP 5.4 for Travis runs. Yep, that's about it.

### PHP 5.5

Provides PHP 5.4 for Travis runs. Yep, that's about it.

## Installation

On a Docker based host run the following command:

```
make build
```
