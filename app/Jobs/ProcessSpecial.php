<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Species;
class ProcessSpecial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $speciesid;
    protected $speciesname;
    /**
     * Create a new job instance.
     */
    public function __construct($speciesid, $speciesname)
    {
        $this->speciesid = $speciesid;
        $this->speciesname = $speciesname;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Species::create([
            "speciesid"=>$this->speciesid,
            "speciesname"=>$this->speciesname
         ]);
    }
}
