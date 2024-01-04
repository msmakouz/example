<?php

require __DIR__ . '/vendor/autoload.php';

use App\Dispatcher\DispatcherInterface;
use App\Dispatcher\HttpDispatcher;
use App\Dispatcher\JobsDispatcher;
use Spiral\RoadRunner\Environment;

/**
 * Collect all dispatchers.
 *
 * @var DispatcherInterface[] $dispatchers
 */
$dispatchers = [
    new HttpDispatcher(),
    new JobsDispatcher(),
];

// Create environment
$env = Environment::fromGlobals();

// Execute dispatcher that can serve the request
foreach ($dispatchers as $dispatcher) {
    if ($dispatcher->canServe($env)) {
        $dispatcher->serve();
    }
}
