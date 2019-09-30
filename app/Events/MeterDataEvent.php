<?php

namespace App\Events;

use App\MeterData;
use Opis\Events\Event;

class MeterDataEvent extends Event
{
    /** @var MeterData */
    protected $meter_data;

    /**
     * @return MeterData
     */
    public function getMeterData(): MeterData
    {
        return $this->meter_data;
    }

    /**
     * @param MeterData $meter_data
     * @return MeterDataEvent
     */
    public function setMeterData(MeterData $meter_data): self
    {
        $this->meter_data = $meter_data;

        return $this;
    }

}
