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
    public $tagnumber;
    public $feedtype;
    public $schedule;
    public $qty;
    public $random_number;
    public $sch_number;
    public $cost;
    public $animal_animalid;
    public $feeddetails;
    public $producationtype;
    public $ration;
    public $ration_composition;
    public $disorders;
    /**
     * Create a new job instance.
     */
    public function __construct($tagnumber, $feedtype, $schedule, $qty, $random_number, $sch_number, $cost, $animal_animalid, $feeddetails, $producationtype, $ration, $ration_composition, $disorders)
    {
        $this->tagnumber = $tagnumber;
        $this->feedtype = $feedtype;
        $this->schedule = $schedule;
        $this->qty = $qty;
        $this->random_number = $random_number;
        $this->sch_number = $sch_number;
        $this->cost = $cost;
        $this->animal_animalid = $animal_animalid;
        $this->feeddetails = $feeddetails;
        $this->producationtype = $producationtype;
        $this->ration = $ration;
        $this->ration_composition = $ration_composition;
        $this->disorders = $disorders;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        DB::transaction(function() {
            try {


                $feed = Feed::create([
                    'feedid' => $this->random_number,
                    'feedtype' => $this->feedtype,
                    'feeddetails' =>$this->feeddetails,
                    'cost' => $this->cost,
                    'producationtype'=>$this->producationtype,
                    'ration'=>$this->ration,
                    'ration_composition'=>$this->ration_composition,
                    'disorders'=>$this->disorders,
                    'tagnumber'=>$this->tagnumber
                ]);



                if (!$feed) {
                    throw new \Exception('Feed creation failed.');
                }

                FeedingSchedule::create([
                    'scheduleid' => $this->sch_number,
                    'animal_animalid' => $this->animal_animalid,
                    'feed_feedid' => $feed->feedid, // Use feedid
                    'date_of_feeding' => $this->schedule,
                    'quantity' => $this->qty
                ]);

                Log::info('FeedingSchedule created successfully.');
            } catch (\Exception $e) {
                Log::error('Error in transaction:', ['message' => $e->getMessage()]);
                throw $e; // Rethrow to rollback transaction
            }
        });



    }
}
