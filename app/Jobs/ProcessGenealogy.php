<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\genealogy;
class ProcessGenealogy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   protected $genealogyid;
   protected $id;
   protected $parenttype;
   protected $parentanimalid;
    /**
     * Create a new job instance.
     */
    public function __construct($genealogyid, $id, $parenttype, $parentanimalid)
    {
        $this->genealogyid = $genealogyid;
        $this->id = $id;
        $this->parenttype = $parenttype;
        $this->parentanimalid = $parentanimalid;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        genealogy::create([
            'genealogyid'=>$this->genealogyid,
            'animal_animalid'=>$this->id,
           'parenttype'=>$this->parenttype,
            'parentanimalid'=>$this->parentanimalid
        ]);
    }
}
