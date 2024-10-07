<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\DeleteExpiredEmail::class,
        \App\Console\Commands\ChangeTrip::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('emails:delete-old')->everyMinute();
        $schedule->command('trips:change')->everyMinute();
        $schedule->command('optimize:clear')->everyTwoHours();
    }

    /** ->sendOutputTo(storage_path('logs/optimize_clear.log'))
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
