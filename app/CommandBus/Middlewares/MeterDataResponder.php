<?php

namespace App\CommandBus\Middlewares;

use League\Tactician\Middleware;
use App\Http\Resources\MeterDataResource;

class MeterDataResponder implements Middleware
{
    public function execute($command, callable $next)
    {
        $next($command);

        return (new MeterDataResource($command))
            ->response()
            ->setStatusCode(200)
            ;
    }
}
