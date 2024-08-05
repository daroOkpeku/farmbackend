<?php

namespace App\Jobs;

use App\Models\Production;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductionCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $production_type;
    public $weight;
    public  $date;
    public $production_cycle;
    public $yield;
    public $cost;
    public $disorders;
    public $estrus_cycle_start_date;
    public $estrus_cycle_end_date;
    public  $tagnumber;
    public $animalid;
    public $quantity;
    /**
     * Create a new job instance.
     */
    public function __construct($production_type, $weight, $date, $production_cycle, $yield, $cost, $disorders, $estrus_cycle_start_date, $estrus_cycle_end_date, $tagnumber, $animalid, $quantity )
    {
        $this->production_type = $production_type;
        $this->weight = $weight;
        $this->date = $date;
        $this->production_cycle = $production_cycle;
        $this->yield = $yield;
        $this->cost = $cost;
        $this->disorders = $disorders;
        $this->estrus_cycle_start_date = $estrus_cycle_start_date;
        $this->estrus_cycle_end_date =$estrus_cycle_end_date;
        $this->tagnumber = $tagnumber;
        $this->animalid = $animalid;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $random_number = rand(0, 10000);
        $produc = Production::where('productionid', $random_number)->exists();
        if(!$produc){
            Production::create([
                'productionid'=>$random_number,
                'animal_animalid'=>$this->animalid,
                'date_of_producation'=>$this->date,
                'production_type'=>$this->production_type,
                   'quantity'=>$this->quantity,
                  'weight'=>$this->weight,
                  'production_cycle'=>$this->production_cycle,
                    'yield'=>$this->yield,
                    'cost'=>$this->cost,
                    'disorders'=>$this->disorders,
                    'estrus_cycle_start_date'=>$this->estrus_cycle_start_date,
                    'estrus_cycle_end_date'=>$this->estrus_cycle_end_date,
                    'tagnumber'=>$this->tagnumber
                ]);
        }
      
    }
}
