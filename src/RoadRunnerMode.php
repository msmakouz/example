<?php

declare(strict_types=1);

namespace App;

enum RoadRunnerMode: string
{
    case Unknown = 'unknown';
    case Http = 'http';
    case Temporal = 'temporal';
    case Jobs = 'jobs';
    case Grpc = 'grpc';
    case Tcp = 'tcp';
    case Centrifuge = 'centrifuge';
}
