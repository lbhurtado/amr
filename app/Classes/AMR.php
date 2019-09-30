<?php

namespace App\Classes;

use App\MeterData;

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
}
