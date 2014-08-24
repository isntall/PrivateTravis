FROM        ubuntu:14.04
MAINTAINER  nick_schuch

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN echo "mysql-server mysql-server/root_password password root" | debconf-set-selections
RUN echo "mysql-server mysql-server/root_password_again password root" | debconf-set-selections
RUN
RUN apt-get install -y mysql-server

EXPOSE 3306

CMD [ "" ]
