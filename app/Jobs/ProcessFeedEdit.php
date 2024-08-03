<?php

namespace App\Jobs;

use App\Models\Feed;
use App\Models\FeedingSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessFeedEdit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tagnumber;
    public $feedtype;
    public $schedule;
    public $qty;
    public $feedid;
    public $cost;
    /**
     * Create a new job instance.
     */
    public function __construct($tagnumber, $feedtype, $schedule, $qty, $feedid, $cost)
    {
        $this->tagnumber = $tagnumber;
        $this->feedtype = $feedtype;
        $this->schedule = $schedule;
        $this->qty = $qty;
        $this->feedid = $feedid;
        $this->cost = $cost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        DB::transaction(function () {
           $feed = Feed::where('feedid', $this->feedid)->first();
           if($feed){
            $feed->fill([
                'feedtype' => $this->feedtype,
                'cost' => $this->cost
            ]);
            $feed->save();
           }
           $feedsch = FeedingSchedule::where('feed_feedid', $this->feedid)->first();
            if($feedsch){
                $feedsch->fill([
                    'date_of_feeding' => $this->schedule,
                    'quantity' => $this->qty  
                ]);
                $feedsch->save();
            }

        });
        
    }
}
