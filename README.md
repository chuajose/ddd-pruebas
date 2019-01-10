# ddd-pruebas
[![Build Status](https://travis-ci.org/chuajose/ddd-pruebas.png?branch=master)](https://travis-ci.org/chuajose/ddd-pruebas)
[![Coverage Status](https://coveralls.io/repos/github/chuajose/ddd-pruebas/badge.svg?branch=master)](https://coveralls.io/github/chuajose/ddd-pruebas?branch=master)

First steps working with DDD

- [x] Create users
- [x] Login users
- [ ] Use JWT
- [ ] Events Kibana Elasticsearch Rabbit



Test Coverage
```
./vendor/bin/phpunit --coverage-html reports/
```


Generate Coveralls
```
./vendor/bin/phpunit --coverage-clover build/logs/clover.xml
./vendor/bin/php-coveralls -v
```
Use Docker to php7.2 from https://github.com/jorge07
