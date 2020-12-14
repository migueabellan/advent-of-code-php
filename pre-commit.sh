#!/bin/bash

docker run -it --rm -v "$PWD":/app composer cscheck
docker run -it --rm -v "$PWD":/app composer csfix
docker run -it --rm -v "$PWD":/app composer phpstan
docker run -it --rm -v "$PWD":/app composer parallel
docker run -it --rm --name aoc -v "$PWD":/app -w /app php:7.4-cli php vendor/bin/phpunit --testdox tests
