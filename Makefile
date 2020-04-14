# Date : 14.04.20
# Author Etienne Crespi

CONSOLE=bin/console
PWD=$(shell pwd)
DC=docker-compose
DB=docker build
DR=docker run
HAS_DOCKER:=$(shell command -v $(DC) 2> /dev/null)

ifdef HAS_DOCKER
	EXEC_PHP=$(DC) exec php
	EXEC_NODE=$(DC) exec node
else
	EXEC_PHP=
	EXEC_NODE=
endif

.DEFAULT_GOAL := help

.PHONY: help ## Generate list of targets with descriptions
help:
		@grep '##' Makefile \
		| grep -v 'grep\|sed' \
		| sed 's/^\.PHONY: \(.*\) ##[\s|\S]*\(.*\)/\1:\t\2/' \
		| sed 's/\(^##\)//' \
		| sed 's/\(##\)/\t/' \
		| expand -t14

##
## Project setup & day to day shortcuts
##---------------------------------------------------------------------------

.PHONY: start ## Start the project (Install in first place)
start:
	$(DC) pull || true
	$(DC) build
	$(DC) up -d
	$(EXEC_PHP) composer install

.PHONY: stop ## Stop the project
stop:
	$(DC) down

.PHONY: exec ## Run bash in the php container
exec:
	$(EXEC_PHP) /bin/bash

##
## Dependencies & environment Files
##---------------------------------------------------------------------------

.env.local: .env
	$(RUN) cp .env .env.local