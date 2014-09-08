FROM       nickschuch/mysql
MAINTAINER nick_schuch

##
# TMPFS Script.
##

ADD ./scripts/start.sh /start.sh
RUN chmod 755 /start.sh

##
# Run tests.
##

ADD Rakefile Rakefile
COPY spec spec
RUN rake spec

CMD [ "/start.sh" ]
