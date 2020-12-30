# Advent Of Code 2020

![Github](https://github.com/migueabellan/advent-of-code-2020/workflows/Test/badge.svg)
![Advent Of Code](https://img.shields.io/badge/Advent%20Of%20Code-2020-blue?style=flat-square)
![php](https://img.shields.io/github/languages/top/migueabellan/advent-of-code-2020?style=flat-square)

<br />

## Installation with docker

### Requirement

- docker 19 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-2020.git

$ docker-compose build
$ docker-compose up -d

$ docker-compose exec php composer install
```

```sh
$ docker-compose exec php bin/console puzzle:exec -y [YEAR] -d [DAY]] -p [PUZZLE] 
```

## Installation without docker

### Requirement

- php 7.2 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-2020.git

$ composer install
```

```sh
$ php bin/console puzzle:exec -y [YEAR] -d [DAY]] -p [PUZZLE]
```
