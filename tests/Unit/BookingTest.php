<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function test_booking_creation_successfully()
    {
        $destination = Destination::factory()->create();

        $user = User::factory()->create();

        $trip = Trip::factory()->create([
            'destination_id' => $destination->id,
            'price' => 102.55,
            'available_seats' => 10,
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(7),
        ]);

        $bookingData = [
            'trip_id' => $trip->id,
            'user_id' => $user->id,
            'seats_booked' => 5,
        ];

        $booking = Booking::create($bookingData);

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals($bookingData['trip_id'], $booking->trip_id);
        $this->assertEquals($bookingData['user_id'], $booking->user_id);
        $this->assertEquals($bookingData['seats_booked'], $booking->seats_booked);
    }


    public function test_booking_fails_due_to_overbooking()
    {
        $destination = Destination::factory()->create();
        $user = User::factory()->create();

        $trip = Trip::factory()->create([
            'destination_id' => $destination->id,
            'price' => 102.55,
            'available_seats' => 2,
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(7),
        ]);

        $bookingData = [
            'trip_id' => $trip->id,
            'user_id' => $user->id,
            'seats_booked' => 3,
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = new \App\Http\Requests\BookingValidate();
        $request->merge($bookingData);

        $this->app['validator']->validate($request->all(), $request->rules());

        Booking::create($bookingData);
    }


    public function test_booking_fails_due_to_dateConflicts()
    {
        $destination = Destination::factory()->create();
        $user = User::factory()->create();

        $trip = Trip::factory()->create([
            'destination_id' => $destination->id,
            'price' => 102.55,
            'available_seats' => 5,
            'start_date' => now(),
            'end_date' => now()->addDays(7),
        ]);

        $bookingData = [
            'trip_id' => $trip->id,
            'user_id' => $user->id,
            'seats_booked' => 3,
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = new \App\Http\Requests\BookingValidate();
        $request->merge($bookingData);

        $this->app['validator']->validate($request->all(), $request->rules());

        Booking::create($bookingData);
    }
}
