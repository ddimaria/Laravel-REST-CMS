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

### Clone this repo
```shell
$ git clone https://github.com/ddimaria/Laravel-REST-CMS.git laravel-rest-cms
$ cd laravel-rest-cms
```

### Run Composer
This assumes you have composer installed and configured to run globally.  For assistance, visit https://getcomposer.org/download/
```shell
$ composer install
```
This creates a /vendor directory and will pull in dependenies. 

### Folder Permissions
```shell
$ find storage/* -type d -exec chmod 775 {} \;
```

### Migrate the Database
```shell
$ php artisan migrate
```

### Seed the Database
```shell
$ php artisan db:seed
```


## Testing
### Basic
``` shell
$ phpunit
```

### With Coverage HTML
``` shell
$ phpunit --coverage-html --coverage-clover=coverage.clover
```


## Packages

### API Approach
This system uses the [thephpleague/fractal](https://github.com/thephpleague/fractal) component, which is "a presentation and transformation layer for complex data output."  This provides a solid foundation for relating models, transforming data, pagination responses and standardizing input parameters.

### Responses
Responses are sent using the [ellipsesynergie/api-response](https://github.com/ellipsesynergie/api-response) package.  This ties into Fractal's Manager object for simplifying and standardizing responses.

### Authentication
The system implements token-based authetication with the [chrisbjr/api-guard](https://github.com/chrisbjr/api-guard) component.  This nifty package plays well with Fractal and Api-Response, and fully abstracts authentication, token generation and maintenence, api rate limiting, access levels, method-level access and full api logging.

### Pagination
When returning data for collection-based endpoints, results are paginated, 15 per page.
```json
"meta": {
    "pagination": {
        "total": 150,
        "count": 15,
        "per_page": 15,
        "current_page": 3,
        "total_pages": 10,
        "links": {
            "previous": "https://localhost/api/v1/pages/?page=2",
            "next": "https://localhost/api/v1/pages/?page=4"
        }
    }
}
```

### Errors
404 responses are returned with a 404 status code and a "Not found!" JSON response:
```json
{
    "error": {
        "message": "Not found!",
        "status_code": 404
    }
}
```

## Usage

### Logging In
```POST /app/v1/user/login```
#### POST
```json
{
	"username": "admin", 
	"password": "123"
}
```
#### Response:
```json
{
  "data": {
    "id": 1,
    "first_name": "Admin",
    "last_name": "User",
    "api_key": "7fa1949b94f9000f4bb558709aee106f8c0d042c",
    "version": "version: 1.0.3"
  }
}
```

### Logging Out
```GET /app/v1/user/logout/{api_key}```
#### Response
```json
{
  "ok": {
    "code": "SUCCESSFUL",
    "http_code": 200,
    "message": "User was successfuly deauthenticated"
  }
}
```

### Simple Page
```GET /app/v1/page/{id}```
#### Response
```json
{
  "data": {
    "id": 1,
    "parent_id": null,
    "template_id": 1,
    "seo_id": null,
    "nav_name": "Home",
    "url": "home",
    "title": "Home Page",
    "sort": 1,
    "created_at": "2016-01-13 07:57:48",
    "updated_at": "2016-01-13 07:57:48",
    "created_by": 1,
    "updated_by": null
  }
}
```

### Page data, including page_detail and template_detail joins
```GET /app/v1/page/{id}/detail```
#### Response
```json
{
  "data": {
    "id": 1,
    "parent_id": null,
    "template_id": 1,
    "seo_id": null,
    "nav_name": "Home",
    "url": "home",
    "title": "Home Page",
    "sort": 1,
    "created_at": "2016-01-13 07:57:48",
    "updated_at": "2016-01-13 07:57:48",
    "created_by": 1,
    "updated_by": null,
    "detail": {
      "data": [
        {
          "id": 1,
          "page_id": 1,
          "template_detail_id": 1,
          "data": "First page content",
          "group": 0,
          "version": 0,
          "created_at": "2016-01-13 07:57:48",
          "updated_at": "2016-01-13 07:57:48",
          "template_detail": {
            "data": [
              {
                "id": 1,
                "parent_id": null,
                "template_id": 1,
                "name": "Main Content",
                "description": null,
                "var": "main_content",
                "type": "wysiwyg",
                "data": null,
                "sort": 9999999,
                "created_at": "2016-01-13 07:57:48",
                "updated_at": "2016-01-13 07:57:48"
              }
            ]
          }
        },
        {
          "id": 2,
          "page_id": 1,
          "template_detail_id": 2,
          "data": "First page sub-content",
          "group": 0,
          "version": 0,
          "created_at": "2016-01-13 07:57:48",
          "updated_at": "2016-01-13 07:57:48",
          "template_detail": {
            "data": [
              {
                "id": 2,
                "parent_id": null,
                "template_id": 1,
                "name": "Sub Content",
                "description": null,
                "var": "main_content",
                "type": "wysiwyg",
                "data": null,
                "sort": 9999999,
                "created_at": "2016-01-13 07:57:48",
                "updated_at": "2016-01-13 07:57:48"
              }
            ]
          }
        }
      ]
    }
  }
}
```

## License

The MIT License (MIT). Please see [License File](https://github.com/ddimaria/Laravel-REST-CMS/blob/master/LICENSE) for more information.
