<?php

namespace SymfonyBundles\QueueBundle\Tests;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    public function setUp()
    {
        $this->container = $this->bootKernel()->getContainer();
    }

    protected function bootKernel()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        return $kernel;
    }

    protected function createKernel()
    {
        return new Fixtures\app\AppKernel('test', true);
    }

}
