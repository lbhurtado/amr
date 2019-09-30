<?php

namespace App\Jobs;

use App\MeterData;
use Illuminate\Bus\Queueable;
use App\Reading as MeterReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Reading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var MeterData */
    protected $meter_data;

    /**
     * Reading constructor.
     * @param MeterData $meter_data
     */
    public function __construct(MeterData $meter_data)
    {
        $this->meter_data = $meter_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $previous_meter_data = MeterData::inLocation($this->meter_data->location)
                                ->usingMeterId($this->meter_data->meter_id)
                                ->orderBy('id', 'desc')
                                ->skip(1)
                                ->take(1)
                                ->get()
                                ->first();

        MeterReading::create([
            'location' => $this->meter_data->location,
            'meter_id' => $this->meter_data->meter_id,
            'current_wh_total' => $this->meter_data->wh_total,
            'current_datetime' => $this->meter_data->datetime,
            'previous_wh_total' => optional($previous_meter_data)->wh_total,
            'previous_datetime' => optional($previous_meter_data)->datetime,
            'diff_wh_total' => is_null($previous_meter_data) ? null : $this->meter_data->wh_total - $previous_meter_data->wh_total,
        ]);
    }
}
