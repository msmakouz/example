<?php

declare(strict_types=1);

namespace App\Dispatcher;

use Spiral\RoadRunner\EnvironmentInterface;

interface DispatcherInterface
{
    public function canServe(EnvironmentInterface $env): bool;

    public function serve(): void;
}
