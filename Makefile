isDocker := $(shell docker info > /dev/null 2>&1 && echo 1)
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

# Executables (local)
DOCKER_COMP = docker-compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) exec php

# Executables
PHP      = $(PHP_CONT) php
COMPOSER = $(PHP_CONT) composer
SYMFONY  = $(PHP_CONT) bin/console

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

## —— Inside php container commands 🎵 ———————————————————————————————————————————————————————————————
composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(COMPOSER) $(c)

db-reset: ## Reset database
	@$(SYMFONY) doctrine:database:drop --force --if-exists -nq
	@$(SYMFONY) doctrine:database:create -nq
	@$(SYMFONY) doctrine:migrations:migrate -nq

pest: ## Run tests
	@$(PHP_CONT) vendor/bin/pest
