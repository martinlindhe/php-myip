## About

Small php library to query current external IP

## Installation

In composer.json

```json
{
    "require": {
        "martinlindhe/php-myip": "~0.1"
    }
}
```


## Usage

```php
$ip = MartinLindhe\MyIp\IpProvider\IpProvider::factory()
    ->getIPv4();
```

