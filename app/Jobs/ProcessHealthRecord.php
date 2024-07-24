<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\HealthRecord;
class ProcessHealthRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     protected $recordid;
     protected $id;
     protected $event_date;
     protected $type_event;
     protected $details;
    /**
     * Create a new job instance.
     */
    public function __construct($recordid, $id, $event_date, $type_event, $details)
    {
        $this->recordid = $recordid;
        $this->id = $id;
        $this->event_date = $event_date;
        $this->type_event = $type_event;
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        HealthRecord::create([
            'recordid'=>$this->recordid,
            'animal_animalid'=>$this->id,
            'event_date'=>$this->event_date,
             'type_event'=>$this->type_event,
            'details'=>$this->details
        ]);

    }
}
