Sitemap Tool for Musement.com
============================================================

## Tech Test Description

Part 1:
https://gist.github.com/hpatoio/dff49e528feaea3f98bf57399d03da63

Part 2:
https://gist.github.com/hpatoio/a81e591335094b8cc98721c7c1035aa1

## Requirements

  - PHP 7.1+
  - [PHP Composer](https://getcomposer.org/)

## Installation and Usage

To install the dependencies run:
```bash
composer install
```

The sitemap tool uses an SMTP to send an email. Before using email sending option change the SMTP configuration in [./config/smtp.config.json](https://github.com/isergi/musement/blob/master/config/smtp.config.json) file.
```bash
{
    "smtp" : true,
    "host" : "smtp1.example.com",
    "auth" : true,
    "username" : "user@example.com",
    "password" : "secret",
    "port" : 587
}
```

### Run Tool

To get usage information run:
```bash
./sitemap-tool --help
```
Usage examples:
```bash
# Generate a new XML sitemap file with a locale fr-FR
./sitemap-tool -f sitemap-fr.xml -l fr-FR -g

# Generate a new XML sitemap file with default locale it-IT and send it to emails nobody@example.com, noreply@example.com
./sitemap-tool -f sitemap-it.xml -g -e nobody@example.com,noreply@example.com

# Send already generated sitemap to the email nobody@example.com
./sitemap-tool -f sitemap.xml -e nobody@example.com
```

## Testing

### Unit Tests

Use PHPUnit to run all sitemap tools tests:
```bash
composer test

PHPUnit 5.7.27 by Sebastian Bergmann and contributors.

.....                                                               5 / 5 (100%)

Time: 1.09 seconds, Memory: 4.00MB

OK (5 tests, 6 assertions)
```

# Troubleshooting

## Unable to Start Sitemap Tool

**Symptom**: 

Getting a "permission denied" message
```bash
$ ./sitemap-tool --help
permission denied: ./sitemap-tool
```

**Solution**:

Try to set **+x** permission to the **sitemap-tool**
```bash
$ chmod +x ./sitemap-tool
```

## Unable to Create Sitemap File

**Symptom**: 

Getting an "unable to open" message
```bash
$ ./sitemap-tool -f /root/sitemap.xml -g
ERROR: Unable to open sitemap file "/test.xml" 
```

**Solution**:

Try to set **write** permission to the directory you are using for a new **sitemap.xml** file or change the directory
```bash
$ ./sitemap-tool -f ./sitemap.xml -g
```

## Unable to Send Sitemap File Via Email

**Symptom**: 

Getting a "could not be sent" message
```bash
$ ./sitemap-tool -f sitemap.xml -e test@example.com
ERROR: Message could not be sent. Mailer Error: SMTP connect() failed.
```

**Solution**:

Check your configuration of the SMTP connection in [./config/smtp.config.json](https://github.com/isergi/musement/blob/master/config/smtp.config.json) file.
```bash
{
    "host" : "smtp1.example.com",
    "auth" : true,
    "username" : "user@example.com",
    "password" : "secret",
    "port" : 587
}
```