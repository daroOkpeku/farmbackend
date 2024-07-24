<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFarmInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $farm;
    /**
     * Create a new job instance.
     */
    public function __construct($farm)
    {
       $this->farm = $farm;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
