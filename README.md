SymfonyBundlesQueueBundle
=========================

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]

[![Build Status][testing-image]][testing-link]
[![Scrutinizer Code Quality][scrutinizer-code-quality-image]][scrutinizer-code-quality-link]
[![Code Coverage][code-coverage-image]][code-coverage-link]
[![Total Downloads][downloads-image]][package-link]
[![Latest Stable Version][stable-image]][package-link]
[![License][license-image]][license-link]

Installation
------------
* Require the bundle with composer:

``` bash
composer require symfony-bundles/queue-bundle
```

* Enable the bundle in the kernel:

``` php
public function registerBundles()
{
    $bundles = [
        // ...
        new SymfonyBundles\QueueBundle\SymfonyBundlesQueueBundle(),
        // ...
    ];
    ...
}
```

* Configure the queue bundle in your config.yml.

Defaults configuration:
``` yml
sb_queue:
    service_name: "queue"
    default_name: "queue:default"
```

* Configure the redis client in your config.yml. Read more about [RedisBundle configuration][redis-bundle-link].

How to use
----------
A simple example of the use of the queue:
``` php
$queue = $this->get('sb_queue'); // get the service
// or use: $this->get('queue'); the `queue` service use as alias,
// which setting in config.yml in parameter service_name

// adding some data to queue
$queue->push('User "demo" registered');
$queue->push(1234567890);
$queue->push(new \stdClass);

// get count of items from queue
$queue->count(); // returns integer: 3
```

``` php
// now, we can get the data at any time in the queue order

// get data from queue
$queue->pop(); // returns string: User "demo" registered
$queue->count(); // returns integer: 2
$queue->pop(); // returns integer: 1234567890
$queue->count(); // returns integer: 1
$queue->pop(); // returns object: object(stdClass)
$queue->count(); // returns integer: 0
```

[package-link]: https://packagist.org/packages/symfony-bundles/queue-bundle
[license-link]: https://github.com/symfony-bundles/queue-bundle/blob/master/LICENSE
[license-image]: https://poser.pugx.org/symfony-bundles/queue-bundle/license
[testing-link]: https://travis-ci.org/symfony-bundles/queue-bundle
[testing-image]: https://travis-ci.org/symfony-bundles/queue-bundle.svg?branch=master
[stable-image]: https://poser.pugx.org/symfony-bundles/queue-bundle/v/stable
[downloads-image]: https://poser.pugx.org/symfony-bundles/queue-bundle/downloads
[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/e288c87f-ddf0-4a1c-81c5-5a7f86ab3351
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/e288c87f-ddf0-4a1c-81c5-5a7f86ab3351/big.png
[code-coverage-link]: https://scrutinizer-ci.com/g/symfony-bundles/queue-bundle/?branch=master
[code-coverage-image]: https://scrutinizer-ci.com/g/symfony-bundles/queue-bundle/badges/coverage.png?b=master
[scrutinizer-code-quality-link]: https://scrutinizer-ci.com/g/symfony-bundles/queue-bundle/?branch=master
[scrutinizer-code-quality-image]: https://scrutinizer-ci.com/g/symfony-bundles/queue-bundle/badges/quality-score.png?b=master
[redis-bundle-link]: https://github.com/symfony-bundles/redis-bundle#installation
