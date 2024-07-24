<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Feed;
class ProcessFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $feedid;
    protected $feedtype;
    protected $feeddetails;
    /**
     * Create a new job instance.
     */
    public function __construct($feedid, $feedtype, $feeddetails)
    {
        $this->feedid = $feedid;
        $this->feedtype = $feedtype;
        $this->feeddetails = $feeddetails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Feed::create([
            'feedid'=>$this->feedid,
            'feedtype'=>$this->feedtype,
            'feeddetails'=>$this->feeddetails
        ]);
    }
}
