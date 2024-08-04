<?php

namespace App\Jobs;

use App\Models\HealthRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessHealthEdit implements ShouldQueue
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
      public $tagnumber;
    /**
     * Create a new job instance.
     */
    public function __construct($vacation_date, $vaccine_name, $treatments, $treatments_date, $illness, $dose, $cost, $treated_by_vcn_number, $status,  $tagnumber)
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
        $this->tagnumber = $tagnumber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $check =   HealthRecord::where('tagnumber', $this->tagnumber)->first();
        if($check){
            $check->fill([
                'vacation_date'=> $this->vacation_date,
                 'vaccine_name'=>$this->vaccine_name,
                 'treatments'=>$this->treatments,
                 'treatments_date'=>$this->treatments_date,
                 'illness'=>$this->illness,
                 'dose'=>$this->dose,
                 'cost'=>$this->cost,
                 'treated_by_vcn_number'=>$this->treated_by_vcn_number,
                 'status'=>$this->status,
                'details'=>'nothing'
            ]);
            $check->save();
        }
    }
}
