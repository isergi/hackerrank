Console Tool for PHP
============================================================

## Read first

Lets me explain why I didn't use a "Symphony/Console" library. Because if you tell me something like that  "showcase your skills and demonstrate a variety of PHP language features and practices, such as OO, as a professional software engineer.", in this way I would not show you a variety of PHP language features and practices that I know, and also I would not show you my OO knowledge it this way. For this reason, I decided to make my own light "console tool application" to show you practices and skills.

Anyway, I used "composer" for several components to show you "a professional software engineer" skills.

For a quick usage you can use `./bin/c-tool.phar` independent script.

## Requirements

  - PHP 5.6+
  - PHP Composer

## Installation and Usage

To install the dependencies run:
```bash
composer install
```

### Run console

To get usage information run:
```bash
./c-tool
```
You can use availabe command for **c-tool**:
```bash
./c-tool help
./c-tool math help
./c-tool math sum numbers=3,4,6,1
```
### Build an independent running script

You can build a single executable script:
```bash
composer build
```
After that you can find the script in the bin folder *./bin/c-tool.phar*

## Testing

### Unit tests

Use PHPUnit to run all console tools tests:
```bash
composer test

PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

......                                                              6 / 6 (100%)

Time: 55 ms, Memory: 4.00MB

OK (6 tests, 11 assertions)
```

# Troubleshooting

## Unable to start console tool

**Symptom**: 

You get a "permission denided" message
```bash
$ ./c-tool math
permission denied: ./c-tool
```

**Solution**:

Try to set **+x** permission to the **c-tool**
```bash
$ chmod +x ./c-tool
```