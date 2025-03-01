# Omnipay: CardPointe

**CardPointe gateway for the Omnipay PHP payment processing library**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/olps/omnipay-cardpointe.svg?style=flat-square)](https://packagist.org/packages/olps/omnipay-cardpointe)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/github/actions/workflow/status/online-postal-scanning/omnipay-cardpointe/tests.yml?branch=main&style=flat-square)](https://github.com/online-postal-scanning/omnipay-cardpointe/actions)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment processing library for PHP. This package implements CardPointe support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply require `league/omnipay` and `olps/omnipay-cardpointe` with Composer:

```bash
composer require league/omnipay olps/omnipay-cardpointe
```

## Basic Usage

The following gateways are provided by this package:

* CardPointe

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay) repository.

### Gateway Parameters

The following parameters are required when creating the gateway:

* `merchantId` - Your CardPointe merchant ID
* `username` - Your CardPointe API username
* `password` - Your CardPointe API password

Additionally, you can set:

* `testMode` - Set to true to use the sandbox environment

### Available Methods

The gateway supports the following methods:

* `authorize()` - Authorize a payment
* `capture()` - Capture a previously authorized payment
* `purchase()` - Authorize and capture a payment
* `refund()` - Refund a previously captured payment
* `void()` - Void a previously authorized payment
* `createCard()` - Store a credit card in the CardPointe vault

## Sandbox Testing

CardPointe provides a sandbox environment for testing your integration. To use the sandbox:

1. Set the gateway to test mode:
   ```php
   $gateway->setTestMode(true);
   ```

2. Use the sandbox credentials provided by CardPointe:
   ```php
   $gateway->setMerchantId('your-test-merchant-id');
   $gateway->setUsername('your-test-username');
   $gateway->setPassword('your-test-password');
   ```

### Obtaining Sandbox Credentials

To obtain sandbox credentials:

1. Contact CardPointe/Fiserv to request a sandbox account
2. You will receive a merchant ID, username, and password for the sandbox environment
3. The sandbox environment is available at `https://api.cardconnect.com/cardconnect/rest`

### Test Card Numbers

You can use the following test card numbers in the sandbox environment:

| Card Type | Card Number      | CVV | Expiry Date |
|-----------|------------------|-----|-------------|
| Visa      | 4111111111111111 | Any | Any future  |
| Mastercard| 5454545454545454 | Any | Any future  |
| Discover  | 6011000000000012 | Any | Any future  |
| Amex      | 371449635398431  | Any | Any future  |

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release announcements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/online-postal-scanning/omnipay-cardpointe/issues),
or better yet, fork the library and submit a pull request.