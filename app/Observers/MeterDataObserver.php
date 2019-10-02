<?php

namespace App\Observers;

use App\MeterData;
use App\Events\{MeterDataEvents, NewMeterData};

class MeterDataObserver
{
    /**
     * Handle the meter data "created" event.
     *
     * @param  \App\MeterData  $meter_data
     * @return void
     */
    public function created(MeterData $meter_data)
    {
        event(MeterDataEvents::CREATED, new NewMeterData($meter_data));
    }
}
