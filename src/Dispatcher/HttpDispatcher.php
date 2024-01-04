<?php

declare(strict_types=1);

namespace App\Dispatcher;

use App\RoadRunnerMode;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Spiral\RoadRunner\EnvironmentInterface;
use Spiral\RoadRunner\Http\PSR7Worker;
use Spiral\RoadRunner\Worker;

final class HttpDispatcher implements DispatcherInterface
{
    public function canServe(EnvironmentInterface $env): bool
    {
        return $env->getMode() === RoadRunnerMode::Http->value;
    }

    public function serve(): void
    {
        $factory = new Psr17Factory();
        $worker = new PSR7Worker(Worker::create(), $factory, $factory, $factory);

        while (true) {
            try {
                $request = $worker->waitRequest();
                if ($request === null) {
                    break;
                }
            } catch (\Throwable $e) {
                $worker->respond(new Response(400));
                continue;
            }

            try {
                // Handle request and return response.
                $worker->respond(new Response(200, [], 'Hello RoadRunner!'));
            } catch (\Throwable $e) {
                $worker->respond(new Response(500, [], 'Something Went Wrong!'));
                $worker->getWorker()->error((string)$e);
            }
        }
    }
}
