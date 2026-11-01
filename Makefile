COMPOSE ?= docker compose
PHP_VERSION ?= 8.4
export PHP_VERSION

.PHONY: build test test-mysql test-postgres test-all down

build:
	$(COMPOSE) build test

test:
	$(COMPOSE) run --rm --build --no-deps test

test-mysql:
	$(COMPOSE) up -d --wait mysql
	DB_CONNECTION=mysql DB_HOST=mysql DB_PORT=3306 DB_DATABASE=master_data_test DB_USERNAME=master DB_PASSWORD=secret $(COMPOSE) run --rm --build --no-deps test

test-postgres:
	$(COMPOSE) up -d --wait postgres
	DB_CONNECTION=pgsql DB_HOST=postgres DB_PORT=5432 DB_DATABASE=master_data_test DB_USERNAME=master DB_PASSWORD=secret $(COMPOSE) run --rm --build --no-deps test

test-all:
	$(MAKE) test
	$(MAKE) test-mysql
	$(MAKE) test-postgres

down:
	$(COMPOSE) down