CONTAINER_NAME=php-fpm

ifeq ($(shell uname -s),Linux)
DOCKER_HOST_IP=$(shell ip -4 addr show docker0 | grep -Po 'inet \K[\d.]+')
else
DOCKER_HOST_IP=$(shell ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1' | awk '{print $1}')
endif

up:
	COMPOSE_PROJECT=symfony-52 HOST_IP=${DOCKER_HOST_IP} docker-compose up -d

build:
	HOST_IP=${DOCKER_HOST_IP} docker-compose build

install:
	docker-compose run --no-deps --rm ${CONTAINER_NAME} composer install --optimize-autoloader

bash:
	docker-compose run --rm ${CONTAINER_NAME} sh

test-unit:
	docker-compose run --rm ${CONTAINER_NAME} vendor/bin/phpunit --order-by=random --testsuite unit

test-integration:
	docker-compose run --rm ${CONTAINER_NAME} vendor/bin/phpunit --order-by=random --testsuite integration

test-functional:
	docker-compose run --rm ${CONTAINER_NAME} vendor/bin/codecept run functional

grumphp:
	docker-compose run --rm ${CONTAINER_NAME} vendor/bin/grumphp run

analyse:
	docker-compose run --rm ${CONTAINER_NAME} vendor/bin/phpstan analyse

format:
	docker-compose run --rm ${CONTAINER_NAME} vendor/bin/php-cs-fixer f

test: test-unit test-integration test-functional analyse