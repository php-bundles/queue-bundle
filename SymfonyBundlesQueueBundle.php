<?php

namespace SymfonyBundles\QueueBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use SymfonyBundles\BundleDependency\BundleDependency;
use SymfonyBundles\BundleDependency\BundleDependencyInterface;

class SymfonyBundlesQueueBundle extends Bundle implements BundleDependencyInterface
{
    use BundleDependency;

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new DependencyInjection\QueueExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function getBundleDependencies()
    {
        return [
            \SymfonyBundles\RedisBundle\SymfonyBundlesRedisBundle::class,
        ];
    }
}
