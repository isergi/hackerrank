Console Tool for PHP
============================================================

This tool just shows an architecture of a simple project.

Please lets me explain why I didn't use more professional way for the console tool application. I mean "Symphony/Console".
Because if you tell me this "to showcase your skills and demonstrate a variety of PHP language features and practices, such as OO, as a professional software engineer.". In this way, I would not show you a variety of PHP language features and practices that I know, and also I would not show you my OO knowledge. 
For this reason, I decided to make my own light "console tool application" to show you practices and skills.

Anyway, I used "composer" for several components to show you "a professional software engineer".

## Requirements

  - PHP 5.4+
  - PHP Composer

## Installation and Usage

### Console Tool code

Copy the "Console Tool" to any directory on your computer.

### Install dependencies 

To install the PHP SDK from the [Central Composer repository](https://packagist.org) use [composer](https://getcomposer.org/download):
```bash
composer install
```

### Run console

To show available commands for the console use command:
```bash
php index.php
```

## Testing

### Unit tests

Use PHPUnit to run all console tools tests:
```bash
./vendor/bin/phpunit tests/

PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

......                                                              6 / 6 (100%)

Time: 55 ms, Memory: 4.00MB

OK (6 tests, 11 assertions)
```

Or you can run just one console tools test you want:
```bash
./vendor/bin/phpunit tests/Console/ConsoleWorkerTest.php

PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: 52 ms, Memory: 4.00MB

OK (2 tests, 4 assertions)
```