<?php
namespace m2broth\HeadersConsumer;

use m2broth\HeadersConsumer\DependencyInjection\Compiler\ReplaceMultiplyConsumerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class HeadersConsumerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ReplaceMultiplyConsumerCompilerPass());
    }
}