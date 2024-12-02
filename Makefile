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
	@docker-compose exec php php vendor/bin/phpunit --testdox tests/Year2024/

day1:
	@docker-compose exec php bin/console puzzle:exec -y 2024 -d 02 -p 1
 
day2:
	@docker-compose exec php bin/console puzzle:exec -y 2024 -d 02 -p 2
