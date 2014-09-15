FROM       privatetravis/base
MAINTAINER nick_schuch

##
# Base.
##

ENV DEBIAN_FRONTEND noninteractive
ENV HOME /root

# Saves us from stale repository issues.
RUN apt-get update

# Some base packages.
RUN apt-get install -y make re2c bison libxml2-dev libssl-dev libbz2-dev libcurl3-dev libdb5.1-dev libjpeg-dev libpng-dev libXpm-dev libfreetype6-dev libt1-dev libgmp3-dev libc-client-dev libldap2-dev libmcrypt-dev libmhash-dev freetds-dev libz-dev libmysqlclient15-dev ncurses-dev libpcre3-dev unixODBC-dev libsqlite-dev libaspell-dev libreadline6-dev librecode-dev libsnmp-dev libtidy-dev libxslt-dev libt1-dev

# Tools for phpenv.
RUN apt-get build-dep -y php5-cli

# Make the PHP compiles go faster.
RUN apt-get install -y ccache

# Ensure we can sudo.
RUN apt-get install -y sudo

### 
# Travis user
##

RUN adduser --disabled-login --gecos 'Travis' travis
RUN echo 'travis ALL=(ALL) NOPASSWD: ALL' >> /etc/sudoers

USER travis
ENV HOME /home/travis
WORKDIR /home/travis

##
# PHPENV.
##

RUN git clone https://github.com/CHH/phpenv.git /tmp/phpenv
RUN /tmp/phpenv/bin/phpenv-install.sh
RUN scp /tmp/phpenv/extensions/* $HOME/.phpenv/libexec/

RUN echo 'eval "$(phpenv init -)"' >> /$HOME/.bashrc
ENV PATH /home/travis/.phpenv/shims:/home/travis/.phpenv/bin:$PATH

RUN git clone git://github.com/nickschuch/php-build.git $HOME/.phpenv/plugins/php-build
RUN sudo $HOME/.phpenv/plugins/php-build/install.sh

##
# Composer.
##

RUN bash -c "wget http://getcomposer.org/composer.phar && chmod 775 composer.phar && sudo mv composer.phar /usr/local/bin/composer"

##
# Travis.
##

RUN sudo gem install travis --no-rdoc --no-ri
RUN mkdir ~/.travis
RUN git clone https://github.com/travis-ci/travis-build.git /home/travis/.travis/travis-build && cd /home/travis/.travis/travis-build && git reset --hard e5553110116f026075d47dfd922c5b7427539dc7
RUN travis version

##
# Run tests.
##

ADD Rakefile Rakefile
COPY spec spec
RUN rake spec

WORKDIR /data

