# DMA Config Writer

A simple pair of classes to write the config files for the [DragonFly Mail Agent](https://github.com/corecode/dma).

## Example

```php
$conf = new Dma\ConfWriter;
$conf->setFilepath("/usr/local/etc/dma/dma.conf");
$conf->setConfig([
    "smarthost" => "smtp.gmail.com",
    "port" => 587,
    "securetransfer" => true,
    "starttls" => true,
    "opportunistic_tls" => true,
    "auth_path" => "/usr/local/etc/dma/auth.conf"
]);
$conf->write();

$conf = new Dma\AuthWriter;
$conf->setFilepath("/usr/local/etc/dma/auth.conf");
$conf->setConfig([
    "host" => "smtp.gmail.com",
    "username" => "me@gmail.com",
    "password" => "my_secret_password"
]);
$conf->write();
```