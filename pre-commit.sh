#!/bin/bash

docker-compose exec php composer cscheck
docker-compose exec php composer csfix
docker-compose exec php composer phpstan
docker-compose exec php composer parallel
