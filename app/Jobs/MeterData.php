<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\MeterDataRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LBHurtado\Tactician\Contracts\CommandInterface;

class MeterData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var CommandInterface */
    protected $command;

    /**
     * MeterData constructor.
     *
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    /**
     * Execute the job.
     *
     * @param MeterDataRepository $repository
     * @return void
     */
    public function handle(MeterDataRepository $repository)
    {
        $repository->create($this->command->getProperties());
    }
}
