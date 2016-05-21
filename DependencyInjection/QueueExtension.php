<?php

namespace SymfonyBundles\QueueBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class QueueExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');

        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setAlias($config['service_name'], 'sb_queue');
        $container->setParameter('sb_queue.default_name', $config['default_name']);

        $container->setParameter('sb_queue.storage.redis.parameters', $config['server']['redis']['parameters']);
        $container->setParameter('sb_queue.storage.redis.options', $config['server']['redis']['options']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_queue';
    }

}
