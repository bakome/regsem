RegSem — The PHP regex relief
=============

[![RegSem Tests Status](https://github.com/bakome/regsem/workflows/test/badge.svg)](https://github.com/bakome/regsem/actions/workflows/test.yml)

[![RegSem Analysis Status](https://github.com/bakome/regsem/workflows/analyse/badge.svg)](https://github.com/bakome/regsem/actions/workflows/analyse.yml)


The easiest way to build robust and meaningful regex expressions in PHP.

### Requirements ###

- PHP >= 8.0

### Setup ###

RegSem can be installed with composer.

```bash
composer require bakome/regsem
```

### Contribute ###

Want to be part of the RegSem project? Perfect! All are welcome! 
Whether you find a bug, have a great feature request feel free to get in touch.

Make sure to read the [Contributing Guide](.github/CONTRIBUTING.md)
before submitting changes.

### Current features ###

- Simple begin and end for expression
- Repetitions
- Special characters

### Basic Usage Example ###

```php
use function Bakome\RegSem\{
    regex,
    beginsWith,
};

$regex = regex(
    beginsWith('Beginning test subject')
);

// Evaluate
$regex('This is false test subject') // Returns true or false

```

### How to run quality tests ###

PhpUnit run:

```sh
composer run phpunit
```

Psalm run:

```sh
composer run psalm
```

Combined run:

```sh
composer run test
```

Run in docker
```sh
docker run --rm -it -w "/regsem" -v "${PWD}:/regsem" php:8.2 vendor/bin/phpunit
docker run --rm -it -w "/regsem" -v "${PWD}:/regsem" php:8.2 vendor/bin/psalm
```

### License ###

This content is released under the (http://opensource.org/licenses/MIT) MIT License.


### TODO

 - Followed by
 - Any char
 - Special chars
 - Capture groups
 - (Characters) classes
