<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FinancialRecord;
class ProcessFinancialRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $recordid;
    protected $id;
    protected $type_of_finance;
    protected $amount;
    protected $date_of_finance;
    protected $details;
    /**
     * Create a new job instance.
     */
    public function __construct($recordid, $id, $type_of_finance, $amount, $date_of_finance, $details)
    {
        $this->recordid = $recordid;
        $this->id = $id;
        $this->type_of_finance = $type_of_finance;
        $this->amount = $amount;
        $this->date_of_finance = $date_of_finance;
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        FinancialRecord::create([
            'recordid'=>$this->recordid,
            'farm_farmid'=>$this->id,
             'type_of_finance'=>$this->type_of_finance,
             'amount'=>$this->amount,
           'date_of_finance'=>$this->date_of_finance,
             'details'=>$this->details
           ]);
    }
}
