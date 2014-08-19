FROM drupal/base

##
# PHP.
##

RUN php-build -i development --pear 5.4.31 $HOME/.phpenv/versions/5.4.26
RUN phpenv rehash
RUN phpenv global 5.4.31

ENTRYPOINT ["travis", "run", "--skip-version-check", "--skip-completion-check"]
