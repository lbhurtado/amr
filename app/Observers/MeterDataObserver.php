<?php

namespace App\Observers;

use App\MeterData;
use Opis\Events\EventDispatcher;
use App\Events\{MeterDataEvents, MeterDataEvent};

class MeterDataObserver
{
    /** @var EventDispatcher */
    protected $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Handle the meter data "created" event.
     *
     * @param  \App\MeterData  $meter_data
     * @return void
     */
    public function created(MeterData $meter_data)
    {
        tap(new MeterDataEvent(MeterDataEvents::CREATED), function ($event) use ($meter_data) {
            $this->dispatcher->dispatch($event->setMeterData($meter_data));
        });
    }
}
