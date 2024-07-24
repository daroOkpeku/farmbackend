<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Animal;
class ProcessAnimalDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $animalid;
    protected $id;
    protected $breed_breedid;
    protected $tagnumber;
    protected $sex;
    protected $date_of_birth;
    protected $acquisition_date;
    /**
     * Create a new job instance.
     */
    public function __construct($animalid, $id, $breed_breedid, $tagnumber, $sex, $date_of_birth, $acquisition_date)
    {
       $this->animalid = $animalid;
       $this->id = $id;
       $this->breed_breedid = $breed_breedid;
       $this->tagnumber = $tagnumber;
       $this->sex = $sex;
       $this->date_of_birth = $date_of_birth;
       $this->acquisition_date = $acquisition_date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Animal::create([
            "animalid"=>$this->animalid,
            "specie_speciesid"=>$this->id,
            "breed_breedid"=>$this->breed_breedid,
            "tagnumber"=>$this->tagnumber,
            "sex"=>$this->sex,
            "date_of_birth"=>$this->date_of_birth,
            "acquisition_date"=>$this->acquisition_date,
        ]);
    }
}
