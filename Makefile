SHELL = /bin/sh

start: docker/start-development
stop: docker/stop-development

# Docker
docker/start-development:
	@docker-compose up -d --build --force-recreate

docker/stop-development:
	@docker-compose down

# Composer
composer/install:
	@docker-compose exec php composer install

lint:
	@docker-compose exec php composer cscheck
	@docker-compose exec php composer csfix
	@docker-compose exec php composer phpstan
	@docker-compose exec php composer parallel

test:
	@docker-compose exec php php vendor/bin/phpunit --testdox tests

# make exec y=2024 d=01 p=1
exec:
	@docker-compose exec php bin/console puzzle:exec -y ${y} -d ${d} -p ${p}
