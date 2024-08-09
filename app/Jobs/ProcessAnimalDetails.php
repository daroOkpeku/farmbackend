<?php

namespace App\Jobs;

use App\Events\AnimalProcessed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Animal;
use App\Models\Animal_livestock;
use Illuminate\Support\Facades\DB;

class ProcessAnimalDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $animal;

    /**
     * Create a new job instance.
     */
    public function __construct( $animal)
    {
  $this->animal = $animal;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


    }
}
