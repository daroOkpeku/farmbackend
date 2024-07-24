<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\AnimalLocation;
class ProcessAnimalLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     protected $locationid;
     protected $farm_id;
     protected $animal_id;
     protected $locationdetails;
     protected $datemovedin;
     protected $datemovedout;
    /**
     * Create a new job instance.
     */
    public function __construct($locationid, $farm_id, $animal_id, $locationdetails, $datemovedin, $datemovedout)
    {
        $this->locationid = $locationid;
        $this->farm_id = $farm_id;
        $this->animal_id = $animal_id;
        $this->locationdetails = $locationdetails;
        $this->datemovedin = $datemovedin;
        $this->datemovedout = $datemovedout;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        AnimalLocation::create([
            'locationid'=>$this->locationid,
            'farm_farmid'=>$this->farm_id,
             'animal_animalid'=>$this->animal_id,
            'locationdetails'=>$this->locationdetails,
              'datemovedin'=>$this->datemovedin,
              'datemovedout'=>$this->datemovedout,
        ]);
    }
}
