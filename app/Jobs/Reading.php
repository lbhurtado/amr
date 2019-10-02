<?php

namespace App\Jobs;

use App\MeterData;
use App\Events\NewMeterData;
use Illuminate\Bus\Queueable;
use App\Reading as MeterReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Reading implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NewMeterData $event)
    {
        $meter_data = $event->getMeterData();
        $previous_meter_data = MeterData::inLocation($meter_data->location)
                                ->usingMeterId($meter_data->meter_id)
                                ->orderBy('id', 'desc')
                                ->skip(1)
                                ->take(1)
                                ->get()
                                ->first();

        MeterReading::create([
            'location' => $meter_data->location,
            'meter_id' => $meter_data->meter_id,
            'current_wh_total' => $meter_data->wh_total,
            'current_datetime' => $meter_data->datetime,
            'previous_wh_total' => optional($previous_meter_data)->wh_total,
            'previous_datetime' => optional($previous_meter_data)->datetime,
            'diff_wh_total' => is_null($previous_meter_data) ? null : $meter_data->wh_total - $previous_meter_data->wh_total,
        ]);
    }
}
