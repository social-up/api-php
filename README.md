# SocialUP PHP API.

[![Latest Version](https://img.shields.io/github/release/social-up/api-php.svg?style=flat-square)](https://github.com/social-up/api-php/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/social-up/api-php.svg?style=flat-square)](https://packagist.org/packages/social-up/api-php)

```php
$client  = new \SocialUp\API\Client('YOUR_KEY');

$balance = $client->balance()->get();
```