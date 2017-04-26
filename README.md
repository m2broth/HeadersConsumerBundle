# HeadersConsumerBundle
Modify current MultiplyConsumer class from the OldSoundRabbitMqBundle.
Add ability to set queues arguments (for headers exchange type) when
binding queues and running rabbitmq:setup-fabric command.

#Setup

Just enable HeadersConsumerBundle in the AppKernel.php.
```php
new m2broth\HeadersConsumer\RabbitMq\HeadersConsumerBundle();

