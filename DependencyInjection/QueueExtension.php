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
    protected function loadInternal(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');

        $container->setAlias($configs['service_name'], 'sb_queue');
        $container->setParameter('sb_queue.default_name', $configs['default_name']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_queue';
    }

}
