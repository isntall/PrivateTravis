PROVIDER := nickschuch

build:
	docker build $(PROVIDER)/base base/.
	docker build $(PROVIDER)/mysql mysql/.
	docker build $(PROVIDER)/postgres postgres/.
	docker build $(PROVIDER)/phpenv phpenv/.
	docker build $(PROVIDER)/php5.4 php5.4/.
	docker build $(PROVIDER)/php5.5 php5.5/.
