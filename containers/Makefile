PROVIDER := nickschuch

build:
	docker build -t $(PROVIDER)/base base/.
	docker build -t $(PROVIDER)/mysql mysql/.
	docker build -t $(PROVIDER)/postgres postgres/.
	docker build -t $(PROVIDER)/phpenv phpenv/.
	docker build -t $(PROVIDER)/php5.4 php5.4/.
	docker build -t $(PROVIDER)/php5.5 php5.5/.
	docker build -t $(PROVIDER)/php5.6 php5.6/.	

pull:
	docker pull $(PROVIDER)/base
	docker pull $(PROVIDER)/mysql
	docker pull $(PROVIDER)/postgres
	docker pull $(PROVIDER)/phpenv
	docker pull $(PROVIDER)/php5.4
	docker pull $(PROVIDER)/php5.5
	docker pull $(PROVIDER)/php5.6
