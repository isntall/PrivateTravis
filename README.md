PrivateTravis
=============

![PrivateTravis logo](./docs/logo.png "PrivateTravis logo")

### Status

[![Build Status](https://travis-ci.org/nickschuch/PrivateTravis.svg?branch=master)](https://travis-ci.org/nickschuch/PrivateTravis) [![Coverage Status](https://coveralls.io/repos/nickschuch/PrivateTravis/badge.png?branch=coveralls)](https://coveralls.io/r/nickschuch/PrivateTravis?branch=coveralls)

### Overview

Runs a private version of the Travis YAML file format on Docker conatainers. Giving you a Private Travis-like setup.

![Diagram](./docs/diagram.png "docs/diagram.png")

### Containers

All the containers that are provided for this CI can be found here:

[Read more about Container docs](containers)

### The compiler

While our containers do run the TravisCI configuration file. They only run the
build "script" instructions. It's up to us to:

* Build all the permutations.
* Links Docker containers so we have "services".

[Read more about the Compiler](compiler)

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

### Packer

Packer is an amazing tool for building prepackaged images. Currently we are only building an AWS image.
A Vagrant image is also on the roadmap.

#### Installation

http://www.packer.io/docs/installation.html

#### Usage

Images can be built via the following commands:

```
$ export AWS_ACCESS_KEY='Super secret access key'
$ export AWS_SECRET_KEY='Super secret secret key'
$ packer build packer/ubuntu/amazon.json
```

### Contribution.

Please see the issue page for a list of tasks we still need to do. If you find a bug please create a new issue.

Cheers!
