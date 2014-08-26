FROM dockerfile/ruby
MAINTAINER nick_schuch

##
# Base.
##

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update -y
RUN apt-get upgrade -y

##
# Serverspec.
##

RUN sudo gem install serverspec
