<?php

namespace App\Jobs;

use App\Models\FinancialRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFinanceRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tagnumber;
    public $production_type;
    public $date_fin;
    public $items;
    public $input_cost;
    public $yield;
    public $current_value;
    public $revenue;
    public $profit;
    /**
     * Create a new job instance.
     */
    public function __construct(
        $tagnumber,
        $production_type,
        $date_fin,
        $items,
        $input_cost,
        $yield,
        $current_value,
        $revenue,
        $profit
    ) {
     $this->tagnumber = $tagnumber;
     $this->production_type = $production_type;
     $this->date_fin = $date_fin;
     $this->items = $items;
     $this->input_cost = $input_cost;
     $this->yield = $yield;
     $this->current_value = $current_value;
     $this->revenue = $revenue;
     $this->profit = $profit;


    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        FinancialRecord::create([
            'tagnumber'=>$this->tagnumber,
            'production_type'=>$this->production_type,
            'date_fin'=>$this->date_fin,
            'items'=>$this->items,
            'input_cost'=>$this->input_cost,
             'yield'=>$this->yield,
             'current_value'=>$this->current_value,
             'revenue'=>$this->revenue,
             'profit'=>$this->profit
        ]);
    }
}
