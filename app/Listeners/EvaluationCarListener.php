<?php

namespace App\Listeners;

use App\Events\EvaluationCarEvent;
use App\Models\Car;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EvaluationCarListener
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
    public function handle(EvaluationCarEvent $event): void
    {
        $car=Car::find($event->car_id);
        $car->numE=$car->numE+1;
        $car->sumE=$car->sumE+$event->rating;
        $car->save();
    }
}
