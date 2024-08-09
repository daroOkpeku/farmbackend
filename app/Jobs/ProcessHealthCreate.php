<?php

namespace App\Jobs;

use App\Models\HealthRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessHealthCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public   $health;
    /**
     * Create a new job instance.
     */
    public function __construct( $health)
    {
      $this->health= $health;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
   
    }
}
