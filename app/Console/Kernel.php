<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
    // do not use  $schedule->command('update:models')->everyFiveSeconds();
      $schedule->command('update:breed')->everyFiveSeconds();
      $schedule->command('update:animal')->everyFiveSeconds();
      $schedule->command('update:farm')->everyFiveSeconds();
    //   $schedule->command('update:health')->everyFiveSeconds();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
