<?php

namespace App\Validators;

use Validator;
use League\Tactician\Middleware;
use App\Exceptions\MeterDataValidationException;

class MeterDataValidator implements Middleware
{
    public function execute($command, callable $next)
    {
        $rules = config('tactician.fields');

        $validator = Validator::make((array) $command, $rules);

        if ($validator->fails()) {
            throw new MeterDataValidationException($command, $validator);
        }

        return $next($command);
    }
}
