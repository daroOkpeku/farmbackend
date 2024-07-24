<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FeedingSchedule;
class ProcessFeedSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $scheduleid;
    protected $animal_id;
    protected $feed_id;
    protected $date_of_feeding;
    protected $quantity;
    /**
     * Create a new job instance.
     */
    public function __construct($scheduleid, $animal_id, $feed_id, $date_of_feeding, $quantity)
    {
        $this->scheduleid = $scheduleid;
        $this->animal_id = $animal_id;
        $this->feed_id = $feed_id;
        $this->date_of_feeding = $date_of_feeding;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        FeedingSchedule::create([
            'scheduleid'=>$this->scheduleid,
            'animal_animalid'=>$this->animal_id,
            'feed_feedid'=>$this->feed_id,
             'date_of_feeding'=>$this->date_of_feeding,
               'quantity'=>$this->quantity
        ]);
    }
}
