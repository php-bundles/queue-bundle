<?php

namespace SymfonyBundles\QueueBundle\Service\Storage;

class RedisStorage implements StorageInterface
{

    /**
     * @var \Predis\ClientInterface
     */
    private $client;

    /**
     * @param array $parameters Connection parameters for one or more servers.
     * @param array $options    Options to configure some behaviours of the client.
     */
    public function __construct(array $parameters = [], array $options = [])
    {
        $this->client = new \Predis\Client($parameters, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function first($key)
    {
        return \unserialize($this->client->lpop($key));
    }

    /**
     * {@inheritdoc}
     */
    public function last($key)
    {
        return \unserialize($this->client->rpop($key));
    }

    /**
     * {@inheritdoc}
     */
    public function append($key, $value)
    {
        $this->client->rpush($key, \serialize($value));
    }

    /**
     * {@inheritdoc}
     */
    public function prepend($key, $value)
    {
        $this->client->lpush($key, \serialize($value));
    }

    /**
     * {@inheritdoc}
     */
    public function count($key)
    {
        return $this->client->llen($key);
    }

}
