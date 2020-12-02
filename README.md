# Advent Of Code 2020

![php](https://img.shields.io/github/languages/top/migueabellan/advent-of-code-2020?style=flat-square)

## Puzzles

This repo contains my solutions to [Advent of Code 2020](https://adventofcode.com/2020).

- [Day 1](app/Day01/README.md)
- [Day 2](app/Day02/README.md)

---

## Installation with docker

### Requirement

- docker 19 or Higher

### Running

```sh
$ git clone git@github.com:migueabellan/advent-of-code-2020.git

$ docker run -it --rm --name aoc -v "$PWD":/usr/src -w /usr/src php:7.4-cli php ./composer.phar install
```

```sh
$ docker run -it --rm --name aoc -v "$PWD":/usr/src -w /usr/src php:7.4-cli php index.php

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
$ php index.php
```
