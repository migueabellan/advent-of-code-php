# Advent Of Code 2020

![Advent Of Code](https://img.shields.io/badge/Advent%20Of%20Code-2020-blue?style=flat-square) ![php](https://img.shields.io/github/languages/top/migueabellan/advent-of-code-2020?style=flat-square)

<br />

## Installation with docker

### Requirement

- docker 19 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-2020.git

$ docker run -it --rm -v "$PWD":/app composer install
```

```sh
$ docker run -it --rm --name aoc -v "$PWD":/app -w /app php:7.4-cli php index.php DayN PuzzleN
```

## Installation without docker

### Requirement

- php 7.2 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-2020.git

$ php ./composer.phar install
```

```sh
$ php index.php DayN PuzzleN
```
