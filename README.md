# HeadersConsumerBundle
Modify current MultiplyConsumer class from the OldSoundRabbitMqBundle.
Add ability to set queues arguments (for headers exchange type) when
binding queues and running rabbitmq:setup-fabric command.

## Installation ##

Require the bundle and its dependencies with composer:

```bash
$ composer require m2broth/headers-consumer-bundle
```
Just enable the HeadersConsumerBundle:
```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        new m2broth\HeadersConsumerBundle\HeadersConsumerBundle();
    );
}
```
