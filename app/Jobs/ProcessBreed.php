<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Breed;
class ProcessBreed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     protected $breedid;
     protected $breedname;
     protected $species_speciesid;
    /**
     * Create a new job instance.
     */
    public function __construct($breedid, $breedname, $species_speciesid)
    {
        $this->breedid = $breedid;
        $this->breedname = $breedname;
        $this->species_speciesid = $species_speciesid;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Breed::create([
            "breedid"=>$this->breedid,
            "breedname"=>$this->breedname,
            "species_speciesid"=>$this->species_speciesid
         ]);
    }
}
