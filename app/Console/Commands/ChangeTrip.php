<?php

namespace App\Console\Commands;

use App\Helpers\DateNow;
use App\Jobs\ChangeStatusTrip;
use App\Models\Trip;
use Illuminate\Console\Command;

class ChangeTrip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trips:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateNow = DateNow::presentTime(now());
        Trip::where('start_date', '<=', $dateNow)
            ->orWhere('end_date', '<=', $dateNow)
            ->chunk(100, function ($trips) {
                foreach ($trips as $trip) {
                    dispatch(new ChangeStatusTrip($trip));
                }
            });
    }
}
