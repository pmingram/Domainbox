# PHP Laravel Domainbox API
[![Build Status](https://travis-ci.org/madeITBelgium/Domainbox.svg?branch=master)](https://travis-ci.org/madeITBelgium/Domainbox)
[![Coverage Status](https://coveralls.io/repos/github/madeITBelgium/Domainbox/badge.svg?branch=master)](https://coveralls.io/github/madeITBelgium/Domainbox?branch=master)
[![Latest Stable Version](https://poser.pugx.org/madeITBelgium/Domainbox/v/stable.svg)](https://packagist.org/packages/madeITBelgium/Domainbox)
[![Latest Unstable Version](https://poser.pugx.org/madeITBelgium/Domainbox/v/unstable.svg)](https://packagist.org/packages/madeITBelgium/Domainbox)
[![Total Downloads](https://poser.pugx.org/madeITBelgium/Domainbox/d/total.svg)](https://packagist.org/packages/madeITBelgium/Domainbox)
[![License](https://poser.pugx.org/madeITBelgium/Domainbox/license.svg)](https://packagist.org/packages/madeITBelgium/Domainbox)

With this Laravel package you create and update domains from domainbox.com.

# Installation

Require this package in your `composer.json` and update composer.

```php
"madeitbelgium/domainbox": "~1.*"
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

```php
MadeITBelgium\Domainbox\DomainboxServiceProvider::class,
```

You can use the facade for shorter code. Add this to your aliases:

```php
'Domainbox' => MadeITBelgium\Domainbox\DomainboxFacade::class,
```

# Documentation
## Usage
```php

use MadeITBelgium\Domainbox\Domainbox;

$domainbox = new Domainbox($reseller, $username, $password, $sandbox); //Sandbox by default false

```

In laravel you can use the Facade
```php
$checkDomainAvailability = Domainbox::domain()->checkDomainAvailability($domainname, $launchPhase = 'GA', $allowOfflineLookups = false, $numberOfRetries = 1); // \MadeITBelgium\Domainbox\Response\DomainAvailable
$checkDomainAvailability->isAvailable();

$checkDomainAvailability = Domainbox::domain()->checkDomainAvailabilityPlus($domainname, $tlds); // Array of \MadeITBelgium\Domainbox\Response\DomainAvailable
$checkDomainAvailability[0]->isAvailable();
```

## Laraval validator
```php

```

The complete documentation can be found at: [http://www.madeit.be/](http://www.madeit.be/)

# Support

Support github or mail: tjebbe.lievens@madeit.be

# Contributing

Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/
# License

This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
