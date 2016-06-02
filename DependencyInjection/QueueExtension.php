<?php

namespace SymfonyBundles\QueueBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class QueueExtension extends ConfigurableExtension
{

    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');

        $container->setAlias($mergedConfig['service_name'], 'sb_queue');
        $container->setParameter('sb_queue.default_name', $mergedConfig['default_name']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_queue';
    }

}
