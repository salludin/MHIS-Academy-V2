# Omnipay: Yandex Money

**Yandex Money driver for the Omnipay Laravel payment processing library**

[![Latest Stable Version](https://poser.pugx.org/ptuchik/omnipay-yandex/version.png)](https://packagist.org/packages/ptuchik/omnipay-yandex)
[![Total Downloads](https://poser.pugx.org/ptuchik/omnipay-yandex/d/total.png)](https://packagist.org/packages/ptuchik/omnipay-yandex)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements Yandex Money support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "ptuchik/omnipay-yandex": "~1.0"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require ptuchik/omnipay-yandex

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize Yandex gateway and make a purchase:

```php

    $gateway = Omnipay::create('Yandex');
    $gateway->setShopId(env('SHOP_ID'));
    $gateway->setSecretKey(env('SECRET_KEY'));
    $gateway->setReturnUrl(env('RETURN_URL'));
    $gateway->setAmount(10); // Amount to charge
    $gateway->setCurrency('RUB'); // Currency
    $purchase = $gateway->purchase()->send();
    
    if ($purchase->isSuccessful()) {
        // Do your logic
    } else {
        throw new Exception($purchase->getMessage());
    }
    
```

3. Initialize Yandex gateway and make a refund:

```php

    $gateway = Omnipay::create('Yandex');
    $gateway->setShopId(env('SHOP_ID'));
    $gateway->setSecretKey(env('SECRET_KEY'));
    $gateway->setReturnUrl(env('RETURN_URL'));
    $gateway->setAmount(10); // Amount to refund
    $gateway->setTransactionReference(10); // Payment ID
    $refund = $gateway->refund()->send();
    
    if ($refund->isSuccessful()) {
        // Do your logic
    } else {
        throw new Exception($refund->getMessage());
    }
    
```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/thephpleague/omnipay-yandex/issues),
or better yet, fork the library and submit a pull request.