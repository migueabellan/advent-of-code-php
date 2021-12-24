# Advent Of Code (PHP)

![Github](https://github.com/migueabellan/advent-of-code-php/workflows/Test/badge.svg)
![php](https://img.shields.io/github/languages/top/migueabellan/advent-of-code-php?style=flat-square)

<br />

## Installation with docker

### Requirement

- docker 19 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-php.git

$ docker-compose build
$ docker-compose up -d

$ docker-compose exec php composer install
```

```sh
$ docker-compose exec php bin/console puzzle:exec [-y|--year YEAR] [-d|--day DAY] [-p|--puzzle PUZZLE]
```

## Installation without docker

### Requirement

- php 8.1 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-php.git

$ composer install
```

```sh
$ php bin/console puzzle:exec [-y|--year YEAR] [-d|--day DAY] [-p|--puzzle PUZZLE]
```
