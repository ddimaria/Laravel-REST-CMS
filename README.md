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

* [Project Homepage](http://www.collectivesessions.com/laravel-rest-cms/)
* [API Docs](http://www.collectivesessions.com/laravel-rest-cms/api-docs/current/)

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

### Environment Configuration
```shell
$ cp .env.example to .env

```
After this file copy, update the attributes in .env to match your environment, database, and mail configurations.

### Create a Unique Encryption Key
```shell
$ php artisan key:generate
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
The testing goal is 100% covearge of non-vendor, non-laravel code.
``` shell
$ phpunit --coverage-html --coverage-clover=coverage.clover
```


## Packages and General Processes

### API Design
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

### Error Responses
404 responses are returned with a 404 status code and a "Not found!" JSON response:
```json
{
    "error": {
        "message": "Not found!",
        "status_code": 404
    }
}
```
Validation errors throw a 422 response:
```json
{
  "error": {
    "code": "GEN-UNPROCESSABLE-ENTITY",
    "http_code": 422,
    "message": [
      "The name field is required.",
      "The layout field is required."
    ]
  }
}
```

### Caching
All models that extend \App\LaravelRestCms\BaseModel implement the \App\LaravelRestCms\CacheTrait in which are cached when saved.

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
    "parent_id": 0,
    "template_id": 1,
    "nav_name": "Home",
    "url": "home",
    "title": "Home Page"
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
    "parent_id": 0,
    "template_id": 1,
    "nav_name": "Home",
    "url": "home",
    "title": "Home Page",
    "detail": {
      "data": [
        {
          "id": 1,
          "page_id": 1,
          "template_detail_id": 1,
          "data": "First page content",
          "group": 0,
          "version": 0,
          "template_detail": {
            "data": [
              {
                "id": 1,
                "parent_id": 0,
                "name": "Main Content",
                "description": null,
                "var": "main_content",
                "type": "wysiwyg",
                "data": null,
                "sort": 1
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
          "template_detail": {
            "data": [
              {
                "id": 2,
                "parent_id": 1,
                "name": "Sub Content",
                "description": null,
                "var": "main_content",
                "type": "wysiwyg",
                "data": null,
                "sort": 1
              }
            ]
          }
        }
      ]
    },
    "parent": {
      "data": []
    }
  }
}
```

### Create a Page
```POST /app/v1/page/{id}```
#### POST
```json
{
    "parent_id" : 1,
    "template_id" : 1,
    "nav_name": "New Page",
    "url": "new-page-here",
    "title" : "New Page Title"
}
```
#### Response
```json
{
  "data": {
    "id": 21,
    "parent_id": 1,
    "template_id": 1,
    "nav_name": "New Page",
    "url": "new-page-here",
    "title": "New Page Title"
  }
}
```

## License

The MIT License (MIT). Please see [License File](https://github.com/ddimaria/Laravel-REST-CMS/blob/master/LICENSE) for more information.
