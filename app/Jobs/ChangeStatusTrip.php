<?php

namespace App\Jobs;

use App\Enums\TripCases;
use App\Helpers\DateNow;
use App\Helpers\LogHelper;
use App\Models\Trip;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeStatusTrip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $trip;
    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }


    public function updateStatus()
    {
        $dateNow = DateNow::presentTime(now());
        $original = $this->trip->statusTrip;

        if ($this->trip->start_date <= $dateNow && $this->trip->end_date > $dateNow && $this->trip->statusTrip != 'inWay') {
            $this->trip->statusTrip = TripCases::InWay->value;

        } elseif ($this->trip->end_date <= $dateNow && $this->trip->statusTrip != 'completed') {
            $this->trip->statusTrip = TripCases::Completed->value;
        }

        if ($original != $this->trip->statusTrip) {
            LogHelper::logInfo('changeStatusTrip', 'job UpdateTrip success', ['data' => $this->trip]);
            $this->trip->save();
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->updateStatus();
    }

    public function failed(Exception $exception)
    {
        LogHelper::logError('changeStatusTrip', 'job UpdateTrip failed', [
            'job' => static::class,
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }

    public function tries()
    {
        return 5;
    }

    public function retryAfter()
    {
        return 3;
    }
}
