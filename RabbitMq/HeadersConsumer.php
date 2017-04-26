<?php
namespace Acceptic\HeadersConsumer\RabbitMq;

use OldSound\RabbitMqBundle\RabbitMq\MultipleConsumer;

/**
 * Just add ability to setup headers exchanges correctly
 *
 * @package Acceptic\HeadersConsumer\RabbitMq
 */
class HeadersConsumer extends MultipleConsumer
{
    /**
     * Add ability to pass queue arguments to the binding
     */
    protected function queueDeclare()
    {
        foreach ($this->queues as $name => $options) {
            list($queueName, ,) = $this->getChannel()->queue_declare($name, $options['passive'],
                $options['durable'], $options['exclusive'],
                $options['auto_delete'], $options['nowait'],
                $options['arguments'], $options['ticket']);

            if (isset($options['routing_keys']) && count($options['routing_keys']) > 0) {
                foreach ($options['routing_keys'] as $routingKey) {
                    $this->queueBind($queueName, $this->exchangeOptions['name'], $routingKey, $options['arguments']);
                }
            } else {
                $this->queueBind($queueName, $this->exchangeOptions['name'], $this->routingKey, $options['arguments']);
            }
        }

        $this->queueDeclared = true;
    }

    /**
     * Pass queue headers to the queue_bind call
     *
     * @param string $queue
     * @param string $exchange
     * @param string $routing_key
     * @param array $arguments
     */
    protected function queueBind($queue, $exchange, $routing_key, array $arguments = [])
    {
        // queue binding is not permitted on the default exchange
        if ('' !== $exchange) {
            $this->getChannel()->queue_bind($queue, $exchange, $routing_key, false, $arguments);
        }
    }
}