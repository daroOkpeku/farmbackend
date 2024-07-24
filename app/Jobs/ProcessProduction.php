<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Production;
class ProcessProduction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   protected $productionid;
   protected $id;
   protected $date_of_producation;
   protected $production_type;
   protected $quantity;
   protected $weight;
    /**
     * Create a new job instance.
     */
    public function __construct($productionid, $id, $date_of_producation, $production_type, $quantity, $weight)
    {
        $this->productionid = $productionid;
        $this->id = $id;
        $this->date_of_producation = $date_of_producation;
        $this->production_type = $production_type;
        $this->quantity = $quantity;
        $this->weight = $weight;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Production::create([
            'productionid'=>$this->productionid,
            'animal_animalid'=>$this->id,
            'date_of_producation'=>$this->date_of_producation,
            'production_type'=>$this->production_type,
               'quantity'=>$this->quantity,
              'weight'=>$this->weight,
         ]);
    }
}
