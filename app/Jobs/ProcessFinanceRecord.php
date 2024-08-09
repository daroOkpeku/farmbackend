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
    public $finance;
   
    /**
     * Create a new job instance.
     */
    public function __construct(
   $finance
    ) {
  
$this->finance = $finance;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    
    }
}
