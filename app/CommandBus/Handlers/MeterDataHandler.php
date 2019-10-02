<?php

namespace App\CommandBus\Handlers;

use App\Jobs\MeterData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use LBHurtado\Tactician\Contracts\CommandInterface;
use LBHurtado\Tactician\Contracts\HandlerInterface;

class MeterDataHandler implements HandlerInterface
{
    use DispatchesJobs;

    /**
     * @param CommandInterface $command
     */
    function handle(CommandInterface $command)
    {
        $this->dispatch(new MeterData($command));
    }
}
