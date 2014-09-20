PrivateTravis
=============

![PrivateTravis logo](./docs/logo.png "PrivateTravis logo")

### Status

[![Build Status](https://travis-ci.org/nickschuch/PrivateTravis.svg?branch=master)](https://travis-ci.org/nickschuch/PrivateTravis) [![Coverage Status](https://coveralls.io/repos/nickschuch/PrivateTravis/badge.png?branch=master)](https://coveralls.io/r/nickschuch/PrivateTravis?branch=master)

### Overview

Runs a private version of the Travis YAML file format on Docker containers. Giving you a Private Travis-like setup.

While our containers do run the TravisCI configuration file. They only run the
build "script" instructions. It's up to us to:

* Build all the permutations.
* Links Docker containers.

![Diagram](./docs/diagram.png "docs/diagram.png")

### Permutations

The following digram demonstrates the how a travis file is converted into
permutations.

![Diagram](./docs/diagram.png "docs/permutations.png")

### Installation

We use composer to pull down the applications dependencies. Run the following
command to get setup:

```
cd PrivateTravis && composer install --prefer-dist
```

### Usage

Here is an example of the command that you can run to compile the .travis.yml
file into the many permutations.

**Basic**:

The very basic command with standard containers.

```
PrivateTravis build
```

**Build and run**

```
PrivateTravis build > run && sh run
```

Note: You will have a build file of "run.sh" leftover after this run, which means that you can either rerun the file or use it for debugging.

**Namespace**:

To override the provider of the containers. A good example of this would be if
you had your own custom containers for testing and/or personal testing.

```
PrivateTravis build --namespace="privatetravis"
```

**Commands**:

This will allow you to define your own custom command groups that will get
loaded from the YAML file.

```
PrivateTravis build env before_script script
```

**YAML**:

This allows for a different file to be loaded from the project.

```
PrivateTravis build --file=".othername.yml"
```

### Testing

This project aims to have full test coverage.

To run tests please run the following command:

```
phing
```

### Containers

All the containers that are provided for this CI can be found here:

[Read more about Container docs](http://github.com/nickschuch/PrivateTravisContainersss)

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
