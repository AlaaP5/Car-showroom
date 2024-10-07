<?php

namespace App\Listeners;

use App\Events\CancelBookingEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CancelBookingListener
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
    public function handle(CancelBookingEvent $event): void
    {
        $event->trip->available_seats += $event->seats_booked;
        if($event->trip->statusTrip === 'full') {
            $event->trip->statusTrip = null;
        }
        ($event->trip)->save();
    }
}
