<?php

namespace App\Jobs;

use App\Models\Animal_livestock;
use App\Models\Feed;
use App\Models\FeedingSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class ProcessFeedCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     public $feed;
    /**
     * Create a new job instance.
     */
    public function __construct($feed)
    {
     
     $this->feed = $feed;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {




    }
}
