<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\RoadRunnerMode;
use Spiral\RoadRunner\EnvironmentInterface;
use Spiral\RoadRunner\Jobs\Consumer;

final class JobsDispatcher implements DispatcherInterface
{
    public function canServe(EnvironmentInterface $env): bool
    {
        return $env->getMode() === RoadRunnerMode::Jobs->value;
    }

    public function serve(): void
    {
        $consumer = new Consumer();

        while ($task = $consumer->waitTask()) {
            try {
                // Handle and process task. Here we just print payload.
                var_dump($task);

                // Complete task.
                $task->complete();
            } catch (\Throwable $e) {
                $task->fail($e);
            }
        }
    }
}
