<?php

namespace App\Jobs;

use App\Models\Production;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductionEdit implements ShouldQueue
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
    public $quantity;
    public $id;
    /**
     * Create a new job instance.
     */
    public function __construct(
        $production_type,
        $weight,
        $date,
        $production_cycle,
        $yield,
        $cost,
        $disorders,
        $estrus_cycle_start_date,
        $estrus_cycle_end_date,
        $tagnumber,
        $quantity,
        $id
        )
    {
    $this->production_cycle = $production_cycle;
    $this->production_type = $production_type;
    $this->weight = $weight;
    $this->date = $date;
    $this->yield = $yield;
    $this->cost = $cost;
    $this->disorders = $disorders;
    $this->estrus_cycle_end_date = $estrus_cycle_end_date;
    $this->estrus_cycle_start_date = $estrus_cycle_start_date;
    $this->tagnumber = $tagnumber;
    $this->quantity = $quantity;
    $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $produc = Production::where(['tagnumber'=>$this->tagnumber, 'id'=>$this->id])->exists();
        if(!$produc){
            $produc->fill([
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
                $produc->save();
        }
    }
}
