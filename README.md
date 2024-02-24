# Bem-vindo à API da SocialUP 🚀

[![Latest Version](https://img.shields.io/github/release/social-up/api-php.svg?style=flat-square)](https://github.com/social-up/api-php/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/social-up/api-php.svg?style=flat-square)](https://packagist.org/packages/social-up/api-php)

---------------

Introdução
---------------
Agora você pode facilmente integrar a sua aplicação com a API da SocialUP. Nossa biblioteca em PHP te permite enviar e consultar o status de suas ordens, conferir o saldo no sistema, solicitar reposição em ordens e muito mais.

Para começar a usar a API, basta criar uma chave de autenticação e seguir as instruções na nossa documentação. 

Qualquer dúvida ou problema, basta abrir uma issue aqui no repositório que nós te ajudamos.

Aproveite ao máximo a API da SocialUP e leve a sua aplicação para outro nível! 😎

Para mais informações, consulte nosso site: [aqui](https://painel.socialuplabs.com/admin/painel/api)

---------------

Primeiros passos
---------------

O método recomendado para instalação da API SocialUP é via
[Composer](https://getcomposer.org/).

```bash
composer require social-up/api-php
```

Então

```php
$client  = new \SocialUp\API\Client('YOUR_KEY');
```

Ping
```php
$ping = $client->ping();
```
Recuperar saldo
```php
$balance = $client->balance()->get();
```
Nova ordem
```php
$data = new \SocialUp\API\Order\Order();
$data->setLink('neymarjr');
$data->setService(39);
$data->setAmount(500);

$order = $client->order()->create($data);
```
Obter ordem
```php
$order = $client->order()->findById(1);
```
