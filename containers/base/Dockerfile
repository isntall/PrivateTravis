FROM       ubuntu:12.04
MAINTAINER nick_schuch

##
# Base.
##

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y build-essential
RUN apt-get install -y software-properties-common
RUN apt-get install -y byobu curl git htop man unzip vim wget
RUN apt-get install -y python-software-properties
RUN rm -rf /var/lib/apt/lists/*

##
# Ruby.
##

RUN apt-add-repository ppa:brightbox/ruby-ng-experimental
RUN apt-get update
RUN apt-get install -y ruby2.0 ruby2.0-dev ruby2.0-doc
RUN rm -rf /var/lib/apt/lists/*

##
# Serverspec.
##

RUN gem install bundler -v 1.6.3
RUN gem install serverspec
RUN gem install rake
