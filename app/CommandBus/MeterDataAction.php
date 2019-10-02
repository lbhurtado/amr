<?php

namespace App\CommandBus;

use App\Validators\MeterDataValidator;
use App\CommandBus\Commands\MeterDataCommand;
use App\CommandBus\Handlers\MeterDataHandler;
use LBHurtado\Tactician\Classes\ActionAbstract;
use App\CommandBus\Middlewares\MeterDataResponder;
use LBHurtado\Tactician\Contracts\ActionInterface;

class MeterDataAction extends ActionAbstract implements ActionInterface
{
    protected $command = MeterDataCommand::class;

    protected $handler = MeterDataHandler::class;

    protected $middlewares = [
        MeterDataValidator::class,
        MeterDataResponder::class,
    ];
}
