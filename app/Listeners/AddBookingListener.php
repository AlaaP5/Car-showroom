<?php

namespace App\Listeners;

use App\Events\AddBookingEvent;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddBookingListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(AddBookingEvent $event): void
    {
        $event->trip->available_seats -= $event->seats_booked;
        if($event->trip->available_seats === 0) {
            $event->trip->statusTrip = 'full';
        }
        $event->trip->save();
    }
}
