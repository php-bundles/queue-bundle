<?php

namespace SymfonyBundles\QueueBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $rootNode = $builder->root('sb_queue');

        $this->addDefaultSection($rootNode);
        $this->addServerSection($rootNode);

        return $builder;
    }

    /**
     * Adds the sb_queue.* configuration
     *
     * @param ArrayNodeDefinition $node
     */
    private function addDefaultSection(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()->children()
                ->scalarNode('service_name')
                    ->defaultValue('queue')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('default_name')
                    ->defaultValue('queue:default')
                    ->cannotBeEmpty()
                ->end()
            ->end();
    }

    /**
     * Adds the sb_queue.server configuration
     *
     * @param ArrayNodeDefinition $node
     */
    private function addServerSection(ArrayNodeDefinition $node)
    {
        $redisNode = $node->addDefaultsIfNotSet()->children()
            ->arrayNode('server')->addDefaultsIfNotSet()->children()
            ->arrayNode('redis');

        $redisNode
            ->fixXmlConfig('parameter')
            ->addDefaultsIfNotSet()->children()
                ->arrayNode('parameters')
                    ->defaultValue(['tcp://localhost?alias=queue'])
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('options')
                ->addDefaultsIfNotSet()->children()
                    ->scalarNode('prefix')->defaultValue('sb_queue:')->end()
                ->end()
            ->end();
    }

}
