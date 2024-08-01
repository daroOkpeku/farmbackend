<?php

namespace App\Jobs;

use App\Events\AnimalProcessed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Animal;
use App\Models\Animal_livestock;
use Illuminate\Support\Facades\DB;

class ProcessAnimalDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $animal_name;
    protected $breed;
    protected $tagnumber;
    protected $sex;
    protected $age;
    protected $weight;
    protected $health_status;
    protected $farmid;
    protected $animalId;
    /**
     * Create a new job instance.
     */
    public function __construct($animal_name, $breed, $tagnumber, $sex, $age, $weight, $health_status, $farmid)
    {
       $this->animal_name = $animal_name;
       $this->breed = $breed;
       $this->tagnumber = $tagnumber;
       $this->sex = $sex;
       $this->age = $age;
       $this->weight = $weight;
       $this->health_status = $health_status;
       $this->farmid = $farmid;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
     $animal =   Animal_livestock::create([
            'name'=>$this->animal_name,
            'sex'=>$this->sex,
            'age'=>$this->age,
            'breed'=>$this->breed,
            'weight'=>$this->weight,
            'tag_id'=>$this->tagnumber,
            'health_status'=>$this->health_status,
            'farm_farmid'=>$this->farmid
        ]);


    }
}
