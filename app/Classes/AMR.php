<?php

namespace App\Classes;

use App\MeterData;
use App\Events\{MeterDataEvents, MeterDataCreated};

class AMR
{
    /** @var MeterData */
    protected $meter_data;

    /**
     * @return MeterData
     */
    public function getMeterData(): ?MeterData
    {
        return $this->meter_data;
    }

    /**
     * @param MeterData $meter_data
     * @return self
     */
    public function setMeterData(MeterData $meter_data): self
    {
        $this->meter_data = $meter_data;

        return $this;
    }

    public function dispatchMeterDataCreatedEvent()
    {
        event(MeterDataEvents::CREATED, new MeterDataCreated($this->meter_data));

        return $this;
    }
}
