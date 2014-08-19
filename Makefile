PROVIDER := drupal

build:
  docker build --rm -t $(PROVIDER)/base base/.
  docker build --rm -t $(PROVIDER)/php5.4 php5.4/.
  docker build --rm -t $(PROVIDER)/php5.5 php5.5/.
