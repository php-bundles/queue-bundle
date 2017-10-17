<?php

namespace SymfonyBundles\QueueBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class QueueExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $configs, ContainerBuilder $container)
    {
        $this->addService($configs, $container);
        $this->addStorage($configs, $container);
    }

    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    private function addService(array $configs, ContainerBuilder $container)
    {
        $alias = $this->getAlias();
        $storageReference = new Reference('sb_queue.storage');

        $service = new Definition($configs['service']['class']);
        $service->addMethodCall('setName', [$configs['settings']['queue_default_name']]);
        $service->addMethodCall('setStorage', [$storageReference]);

        $container->setDefinition($alias, $service);
        $container->setAlias($configs['service']['alias'], $alias);
    }

    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    private function addStorage(array $configs, ContainerBuilder $container)
    {
        if (false === isset($configs['storages'][$configs['service']['storage']])) {
            throw new \InvalidArgumentException(sprintf('Not available storage `%s`.', $configs['service']['storage']));
        }

        $parameters = $configs['storages'][$configs['service']['storage']];

        $storage = new Definition($parameters['class']);
        $storage->addArgument(new Reference($parameters['client']));

        $container->setDefinition('sb_queue.storage', $storage);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'sb_queue';
    }
}
