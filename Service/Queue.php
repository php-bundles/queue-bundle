<?php

namespace SymfonyBundles\QueueBundle\Service;

class Queue implements QueueInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Storage\StorageInterface
     */
    private $storage;

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setStorage(Storage\StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function pop()
    {
        return $this->storage->first($this->name);
    }

    /**
     * {@inheritdoc}
     */
    public function push($value)
    {
        $this->storage->append($this->name, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->storage->count($this->name);
    }
}
