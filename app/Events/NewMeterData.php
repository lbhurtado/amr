<?php

namespace App\Events;

use App\MeterData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMeterData
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @MeterData */
    protected $meter_data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MeterData $meter_data)
    {
        $this->meter_data = $meter_data;
    }

    public function getMeterData(): MeterData
    {
        return $this->meter_data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
