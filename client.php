<?php

declare(strict_types=1);

use Spiral\Goridge\RPC\RPC;
use Spiral\RoadRunner\Jobs\Jobs;

require __DIR__ . '/vendor/autoload.php';

$jobs = new Jobs(RPC::create('tcp://127.0.0.1:6001'));
$queue = $jobs->connect('default');

$task = $queue->dispatch(
    $queue->create('some-job', json_encode(['foo' => 'bar']))
);

echo \sprintf('Job ID: %s', $task->getId());
