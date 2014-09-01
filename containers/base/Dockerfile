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
RUN rm -rf /var/lib/apt/lists/*

##
# Ruby.
##

RUN apt-get install -y ruby1.9.1 ruby1.9.1-dev
RUN rm -rf /var/lib/apt/lists/*

##
# Serverspec.
##

RUN gem install bundler -v 1.6.3
RUN gem install serverspec
RUN gem install rake
