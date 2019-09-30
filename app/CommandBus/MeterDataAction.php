<?php

namespace App\CommandBus;

use App\MeterData;
use App\Facades\AMR;
use App\Jobs\Reading;
use App\Validators\MeterDataValidator;
use App\CommandBus\Commands\MeterDataCommand;
use App\CommandBus\Handlers\MeterDataHandler;
use LBHurtado\Tactician\Classes\ActionAbstract;
use App\Events\{MeterDataEvents, MeterDataEvent};
use LBHurtado\Tactician\Contracts\ActionInterface;
use App\CommandBus\Middlewares\MeterDataResponder;

class MeterDataAction extends ActionAbstract implements ActionInterface
{
    protected $command = MeterDataCommand::class;

    protected $handler = MeterDataHandler::class;

    protected $middlewares = [
        MeterDataValidator::class,
        MeterDataResponder::class,
    ];

    public function setup()
    {
        $this->getDispatcher()->handle(MeterDataEvents::CREATED, function (MeterDataEvent $event) {
            tap($event->getMeterData(), function (MeterData $meter_data) {
                AMR::setMeterData($meter_data);
                $this->dispatch(new Reading($meter_data));
            });
        });
    }
}
