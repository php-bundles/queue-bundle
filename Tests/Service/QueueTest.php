<?php

namespace SymfonyBundles\QueueBundle\Tests\Service;

use SymfonyBundles\QueueBundle\Tests\TestCase;

class QueueTest extends TestCase
{

    /**
     * @var \SymfonyBundles\QueueBundle\Service\QueueInterface
     */
    protected $queue;

    public function setUp()
    {
        parent::setUp();

        $this->queue = $this->container->get('sb_queue');

        $this->queue->setName('unit-test');

        while ($this->queue->count()) {
            $this->queue->pop();
        }
    }

    public function testPop()
    {
        $this->assertSame(false, $this->queue->pop());
    }

    public function testPush()
    {
        $this->assertSame(null, $this->queue->push('one'));
        $this->assertSame(null, $this->queue->push('two'));

        $this->assertSame('one', $this->queue->pop());
        $this->assertSame('two', $this->queue->pop());
    }

    public function testCount()
    {
        $this->assertSame(0, $this->queue->count());

        $list = [1, true, 'three', false, 'five', E_ALL];

        foreach ($list as $item) {
            $this->queue->push($item);
        }

        $this->assertSame(count($list), $this->queue->count());

        foreach ($list as $item) {
            $this->assertSame($item, $this->queue->pop());
        }

        $this->assertSame(0, $this->queue->count());
    }

}
