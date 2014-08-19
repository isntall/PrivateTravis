PROVIDER := drupal

build:
	docker build --no-cache --rm -t $(PROVIDER)/base base/.
	docker build --no-cache --rm -t $(PROVIDER)/php5.4 php5.4/.
	docker build --no-cache --rm -t $(PROVIDER)/php5.5 php5.5/.
