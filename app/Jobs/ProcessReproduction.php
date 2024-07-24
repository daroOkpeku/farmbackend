<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Reproduction;
class ProcessReproduction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     protected $reproductionid;
     protected $id;
     protected $breedingdate;
     protected $pregnancycheckdate;
     protected $outcome;
     protected $birtheventdate;
    /**
     * Create a new job instance.
     */
    public function __construct($reproductionid, $id, $breedingdate, $pregnancycheckdate, $outcome, $birtheventdate )
    {
       $this->reproductionid = $reproductionid;
       $this->id = $id;
       $this->breedingdate = $breedingdate;
       $this->pregnancycheckdate = $pregnancycheckdate;
       $this->outcome = $outcome;
       $this->birtheventdate = $birtheventdate;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Reproduction::create([
            'reproductionid'=>$this->reproductionid,
            'animal_animalid'=>$this->id,
            'breedingdate'=>$this->breedingdate,
            'pregnancycheckdate'=>$this->pregnancycheckdate,
             'outcome'=>$this->outcome,
            'birtheventdate'=>$this->birtheventdate,
        ]);
    }
}
