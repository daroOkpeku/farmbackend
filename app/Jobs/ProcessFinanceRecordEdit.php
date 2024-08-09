<?php

namespace App\Jobs;

use App\Models\FinancialRecord;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFinanceRecordEdit implements ShouldQueue
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
    public $id;
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
    $profit,
    $id
    )
    {
        $this->tagnumber = $tagnumber;
        $this->production_type = $production_type;
        $this->date_fin = $date_fin;
        $this->items = $items;
        $this->input_cost = $input_cost;
        $this->yield = $yield;
        $this->current_value = $current_value;
        $this->revenue = $revenue;
        $this->profit = $profit;
        $this->id  = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $finance = FinancialRecord::where(['tagnumber'=> $this->tagnumber, 'id'=>$this->id])->first();
       if($finance){
        $finance->fill([
            'production_type'=>$this->production_type,
            'date_fin'=>$this->date_fin,
            'items'=>$this->items,
            'input_cost'=>$this->input_cost,
             'yield'=>$this->yield,
             'current_value'=>$this->current_value,
             'revenue'=>$this->revenue,
             'profit'=>$this->profit
        ]);
        $finance->save();
       }
    }
}
