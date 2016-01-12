# Larevel REST CMS
A Laravel 5 based REST Server for Content Management

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/ddimaria/Laravel-REST-CMS/master.svg?style=flat-square)](https://travis-ci.org/ddimaria/Laravel-REST-CMS)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ddimaria/Laravel-REST-CMS/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ddimaria/Laravel-REST-CMS/?branch=master)
[![Coverage Status](https://coveralls.io/repos/ddimaria/Laravel-REST-CMS/badge.svg?branch=master&service=github)](https://coveralls.io/github/ddimaria/Laravel-REST-CMS?branch=master)
[![Latest Version](https://img.shields.io/github/release/ddimaria/Laravel-REST-CMS.svg?style=flat-square)](https://github.com/ddimaria/Laravel-REST-CMS/releases)

This package complies with [PSR-1], [PSR-2] and [PSR-4].

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Requirements

* PHP >= 5.5.9
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension

## Installation
After ensuring that you meet the above requirements, follow the below procedures for installing Laravel REST CMS

###Clone this repo
```bash
$ git clone https://github.com/ddimaria/Laravel-REST-CMS.git laravel-rest-cms
$ cd laravel-rest-cms
```

###Run Composer
This assumes you have composer installed and configured to run globally.  For assistance, visit https://getcomposer.org/download/
```shell
$ composer install
```
This creates a /vendor directory and will pull in dependenies. 

###Folder Permissions
```shell
$ find storage/* -type d -exec chmod 775 {} \;
```
## Testing

``` bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/thephpleague/fractal/blob/master/LICENSE) for more information.
