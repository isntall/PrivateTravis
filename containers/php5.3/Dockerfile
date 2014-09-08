FROM       nickschuch/phpenv
MAINTAINER nick_schuch

##
# PHP.
##

RUN sudo php-build -i development --pear 5.3.29 $HOME/.phpenv/versions/5.3.29
RUN sudo chown -R travis:travis $HOME/.phpenv
RUN phpenv rehash
RUN phpenv global 5.3.29

ENTRYPOINT ["travis", "run", "--skip-version-check", "--skip-completion-check"]
