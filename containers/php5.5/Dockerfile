FROM        drupal/phpenv
MAINTAINER  nick_schuch

##
# PHP.
##

RUN php-build -i development --pear 5.5.15 $HOME/.phpenv/versions/5.5.15
RUN phpenv rehash
RUN phpenv global 5.5.15

ENTRYPOINT ["travis", "run", "--skip-version-check", "--skip-completion-check"]
