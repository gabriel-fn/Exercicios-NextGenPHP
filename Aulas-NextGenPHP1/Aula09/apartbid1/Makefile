.PHONY: up
up:
	docker compose up -d

.PHONY: install
install:
	docker compose exec -u application:application server composer install

.PHONY: container
container:
	docker compose exec -u application:application server bash

.PHONY: stop
stop:
	docker compose stop
