<?php

namespace SymfonyBundles\QueueBundle\Tests\DependencyInjection;

use SymfonyBundles\QueueBundle\Tests\TestCase;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use SymfonyBundles\QueueBundle\DependencyInjection\Configuration;

class ConfigurationTest extends TestCase
{
    public function testConfiguration()
    {
        $processor = new Processor();
        $configuration = new Configuration();

        $this->assertInstanceOf(ConfigurationInterface::class, $configuration);

        $configs = $processor->processConfiguration($configuration, []);

        $this->assertArraySubset([], $configs);
    }
}
