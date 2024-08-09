<?php

namespace App\Jobs;

use App\Models\Animal_livestock;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessEditAnimalDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $animal_name;
    public  $breed;
    public $tagnumber;
    public $sex;
    public $age;
    public $weight;
    public $health_status;
    public $farmid;
    public $id;
    /**
     * Create a new job instance.
     */
    public function __construct($animal_name,  $breed, $tagnumber, $sex, $age, $weight, $health_status, $farmid, $id)
    {
        $this->animal_name = $animal_name;
        $this->breed = $breed;
        $this->tagnumber = $tagnumber;
        $this->sex = $sex;
        $this->age = $age;
        $this->weight = $weight;
        $this->health_status = $health_status;
        $this->farmid = $farmid;
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $animal = Animal_livestock::where(['tag_id' => $this->tagnumber, 'id' => $this->id])->first();
        if ($animal) {
            $animal->fill([
                'name' => $this->animal_name,
                'sex' => $this->sex,
                'age' => $this->age,
                'breed' => $this->breed,
                'weight' => $this->weight,
                'health_status' => $this->health_status,
            ]);
            $animal->save();
        }
    }
}
