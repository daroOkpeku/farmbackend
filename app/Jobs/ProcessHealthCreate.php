<?php

namespace App\Jobs;

use App\Models\HealthRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessHealthCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
      public $vacation_date;
      public $vaccine_name;
      public $treatments;
      public $treatments_date;
      public $illness;
      public $dose;
      public $cost;
      public $treated_by_vcn_number;
      public $status;
      public $animalId;
      public $tagnumber;
    /**
     * Create a new job instance.
     */
    public function __construct($vacation_date, $vaccine_name, $treatments, $treatments_date, $illness, $dose, $cost, $treated_by_vcn_number, $status, $animalId, $tagnumber)
    {
        $this->vacation_date = $vacation_date;
        $this->vaccine_name =  $vaccine_name;
        $this->treatments = $treatments;
        $this->treatments_date = $treatments_date;
        $this->illness = $illness;
        $this->dose = $dose;
        $this->cost = $cost;
        $this->treated_by_vcn_number = $treated_by_vcn_number;
        $this->status = $status;
        $this->animalId = $animalId;
        $this->tagnumber = $tagnumber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sch_number = rand(0, 10000);
        $health = HealthRecord::where('recordid', $sch_number)->exists();
        if(!$health){
            HealthRecord::create([
                'recordid'=>$sch_number,
                'animal_animalid'=>$this->animalId,
                'vacation_date'=> $this->vacation_date,
                 'vaccine_name'=>$this->vaccine_name,
                 'treatments'=>$this->treatments,
                 'treatments_date'=>$this->treatments_date,
                 'illness'=>$this->illness,
                 'dose'=>$this->dose,
                 'cost'=>$this->cost,
                 'treated_by_vcn_number'=>$this->treated_by_vcn_number,
                 'status'=>$this->status,
                 'tagnumber'=>$this->tagnumber,
                'details'=>'nothing'

            ]);
        }
    }
}
