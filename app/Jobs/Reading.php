<?php

namespace App\Jobs;

use App\MeterData;
use App\Events\MeterDataCreated;
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
     * @param MeterDataCreated $event
     */
    public function handle(MeterDataCreated $event)
    {
        $meter_data = $event->getMeterData();

        $previous_meter_data = MeterData::inLocation($meter_data->location)
                                ->usingMeterId($meter_data->meter_id)
                                ->orderBy('id', 'desc')
                                ->skip(1)
                                ->take(1)
                                ->get()
                                ->first();

        $count = MeterData::inLocation($meter_data->location)->usingMeterId($meter_data->meter_id)->max('id');

//        MeterData::inLocation('EDMI')->usingMeterId('217064051')->orderBy('id', 'desc')->skip(1)->take(1)->get()->first();

        MeterReading::create([
            'previous_meter_data_id' => $previous_meter_data->id,
            'meter_data_id' => $meter_data->id,
            'sequence_id' => $count,
            'location' => $meter_data->location,
            'meter_id' => $meter_data->meter_id,
            'current_wh_total' => $meter_data->wh_total,
            'current_datetime' => $meter_data->datetime,
            'previous_wh_total' => optional($previous_meter_data)->wh_total ?? 0,
            'previous_datetime' => optional($previous_meter_data)->datetime,
            'diff_wh_total' => is_null($previous_meter_data) ? null : $meter_data->wh_total - $previous_meter_data->wh_total,
        ]);
    }
}
