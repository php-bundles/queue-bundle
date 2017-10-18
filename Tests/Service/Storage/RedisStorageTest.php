<?php

namespace SymfonyBundles\QueueBundle\Tests\Service\Storage;

use SymfonyBundles\QueueBundle\Tests\TestCase;

class RedisStorageTest extends TestCase
{
    /**
     * @var \SymfonyBundles\QueueBundle\Service\Storage\StorageInterface
     */
    private $storage;

    public function setUp()
    {
        parent::setUp();

        $this->storage = $this->container->get('sb_queue.storage');

        while ($this->storage->count('unit-test')) {
            $this->storage->first('unit-test');
        }
    }

    public function testCount()
    {
        $this->assertSame(0, $this->storage->count('unit-test'));

        $this->insert();

        $this->assertSame(2, $this->storage->count('unit-test'));
    }

    public function testFirst()
    {
        $this->insert();

        $this->assertSame('hello', $this->storage->first('unit-test'));
        $this->assertSame('world', $this->storage->first('unit-test'));
    }

    public function testLast()
    {
        $this->insert();

        $this->assertSame('world', $this->storage->last('unit-test'));
        $this->assertSame('hello', $this->storage->last('unit-test'));
    }

    public function testAppendAndPrepend()
    {
        $this->storage->append('unit-test', 'second');
        $this->storage->prepend('unit-test', 'first');
        $this->storage->append('unit-test', 3);
        $this->storage->prepend('unit-test', 0);

        $this->assertSame(0, $this->storage->first('unit-test'));
        $this->assertSame(3, $this->storage->last('unit-test'));
        $this->assertSame('first', $this->storage->first('unit-test'));
        $this->assertSame('second', $this->storage->last('unit-test'));
    }

    private function insert()
    {
        $this->storage->append('unit-test', 'world');
        $this->storage->prepend('unit-test', 'hello');
    }
}
