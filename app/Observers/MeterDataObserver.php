<?php

namespace App\Observers;

use App\MeterData;
use App\Facades\AMR;

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
        AMR::setMeterData($meter_data)->dispatchMeterDataCreatedEvent();
    }
}
