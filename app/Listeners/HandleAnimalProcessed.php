<?php

namespace App\Listeners;

use App\Events\AnimalProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class HandleAnimalProcessed
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AnimalProcessed $event): void
    {
        Cache::put('animal_id', $event->animalid, 60);

    }
}
