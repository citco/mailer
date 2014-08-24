# Citco Mailer : Better tracking of mails sent with Laravel's Mailer

Citco Mailer is developed by [Creative Investments Technologies](http://creativeinvestments.co.uk) as an extension to Mailer package provided by [Laravel framework](http://www.laravel.com)

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
After updating composer, add the MailerServiceProvider to the providers array in app/config/app.php

    'Citco\Mailer\MailerServiceProvider',

## Basic Usage

Before using Citco Mailer you should edit src/config/config.php wich includes some configuration variables. After editing this file, when using Citco Mailer for outgoing email messages, it will add information needed for tracking to the message.

## License

Citco Mailer is open-sourced software licensed under [the MIT license](http://opensource.org/licenses/MIT)

Copyright [Creative Investments Technologies](http://creativeinvestments.co.uk)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
