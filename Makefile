isDocker := $(shell docker info > /dev/null 2>&1 && echo 1)
domain := "grafikart.fr"
server := "grafikart"
user := $(shell id -u)
group := $(shell id -g)

ifeq ($(isDocker), 1)
	dc := USER_ID=$(user) GROUP_ID=$(group) docker-compose
	dcimport := USER_ID=$(user) GROUP_ID=$(group) docker-compose -f docker-compose.import.yml
	de := docker-compose exec
	dr := $(dc) run --rm
	sy := $(de) php bin/console
	drtest := $(dc) -f docker-compose.test.yml run --rm
	node := $(dr) node
	php := $(dr) --no-deps php
else
	sy := php bin/console
	node :=
	php :=
endif

.PHONY: build-docker
build-docker:
	$(dc) pull --ignore-pull-failures
	$(dc) build --no-cache php

.PHONY: dev
dev:
	$(dc) up -d

test:
	php ./vendor/bin/pest

scan:
	php ./vendor/bin/ecs check

scan-fix:
	php ./vendor/bin/ecs check --fix
