# Citco Mailer : Better tracking of mails sent with Laravel's Mailer

Citco Mailer is developed by [CreativeInvestmentsTechnologies Co.](http://creativeinvestments.co.uk) as an extension to Mailer package provided by [Laravel framework](http://www.laravel.com)

## About

Citco Mailer adds some unique features to original Mailer provided by Laravel framework. These features include:

*  Adding custom headers to outgoing mails for better tracking of bounced mails
*  Log all outgoing mails by auto forwarding them to a special log email address
*  More help on email tracking by generating a reply-path alias for each receiver, based on receiver's email address

## Installation

### Composer

From the Command Line:

```
composer require citco/mailer:dev-master
```

In your `composer.json`:

``` json
{
    "require": {
        "citco/mailer": "dev-master"
    }
}
```

## Basic Usage

``` php
<?php

require 'vendor/autoload.php';

Use Citco\Mailer;

//Complete UsageGuide

```

## License

Citco Mailer is open-sourced software licensed under [the MIT license](http://opensource.org/licenses/MIT)

