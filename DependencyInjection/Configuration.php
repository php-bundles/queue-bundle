<?php

namespace SymfonyBundles\QueueBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('sb_queue')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('service_name')
                    ->defaultValue('queue')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('default_name')
                    ->defaultValue('queue:default')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $builder;
    }

}
