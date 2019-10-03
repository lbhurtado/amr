<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\HourlyReport as Model;
use App\Events\MeterDataCreated;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class HourlyReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param MeterDataCreated $event
     */
    public function handle(MeterDataCreated $event)
    {
        $meter_data = $event->getMeterData();

        $model = Model::firstOrCreate([
            'location' => $meter_data->location,
            'meter_id' => $meter_data->meter_id,
            'hour_of_day' => Carbon::parse($meter_data->datetime)->hour,
        ], [
            'date' => $meter_data->datetime,
            'time' => $meter_data->datetime,
            'wh_total' => $meter_data->wh_total,
            'datetime' => $meter_data->datetime,
        ]);

        if ($model->exists) {
            if ($meter_data->datetime < $model->datetime) {
                $model->update([
                    'date' => $meter_data->datetime,
                    'time' => $meter_data->datetime,
                    'wh_total' => $meter_data->wh_total,
                    'datetime' => $meter_data->datetime
                ]);
            }
        }
    }
}
