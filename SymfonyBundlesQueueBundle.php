<?php

namespace SymfonyBundles\QueueBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SymfonyBundlesQueueBundle extends Bundle
{

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new DependencyInjection\QueueExtension();
    }

}
