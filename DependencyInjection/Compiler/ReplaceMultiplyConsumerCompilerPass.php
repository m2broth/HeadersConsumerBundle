<?php
namespace m2broth\HeadersConsumerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ReplaceMultiplyConsumerCompilerPass implements CompilerPassInterface
{
    /**
     * Replace the MultiplyConsumer class from the OldSoundRabbitMqBundle
     * to HeadersConsumer
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $enabledBundles = $container->getParameter('kernel.bundles');

        //check if OldSoundRabbitMqBundle installed
        if (!isset($enabledBundles['OldSoundRabbitMqBundle'])) {
            throw new \LogicException('
                You need to enable "OldSoundRabbitMqBundle" as well
            ');
        }

        //replace class for all multiply consumers
        foreach ($container->findTaggedServiceIds('old_sound_rabbit_mq.multi_consumer') as $id => $attributes) {
            $definition = $container->getDefinition($id);
            $definition->setClass('m2broth\HeadersConsumer\RabbitMq\HeadersConsumer');
        }
    }
}