<?php

namespace App\Listeners;

use App\Jobs\HourlyReport;
use App\Events\MeterDataEvents;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

class MeterDataEventSubscriber implements ShouldQueue
{
    use InteractsWithQueue, DispatchesJobs;

    public function subscribe($events)
    {
        $events->listen(MeterDataEvents::CREATED, HourlyReport::class);
    }
}
