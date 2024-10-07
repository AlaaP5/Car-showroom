<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BookingProcessTest extends TestCase
{
    use RefreshDatabase;


    public function test_authenticated_user_create_booking_successfully()
    {
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $this->actingAs($user, 'api');

        $destination = Destination::factory()->create();

        $trip = Trip::factory()->create([
            'destination_id' => $destination->id,
            'price' => 222.22,
            'available_seats' => 10,
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(5),
            'statusTrip' => 'pending'
        ]);

        $bookingData = [
            'trip_id' => $trip->id,
            'seats_booked' => 10,
        ];

        $response = $this->postJson('/api/booking/create', $bookingData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'The Booking is added Successfully',
            ]);

        $updatedTrip = $trip->fresh();

        $this->assertEquals(0, $updatedTrip->available_seats);

        $this->assertEquals('full', $updatedTrip->statusTrip);
    }


    public function test_authenticated_user_create_booking_notValidation()
    {
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        $this->actingAs($user, 'api');

        $destination = Destination::factory()->create();

        Trip::factory()->create([
            'destination_id' => $destination->id,
            'price' => 222.22,
            'available_seats' => 10,
            'start_date' => now()->addDays(1),
            'end_date' => now()->addDays(5),
            'statusTrip' => 'pending'
        ]);

        $bookingData = [
            'trip_id' => 2,
            'seats_booked' => 10,
        ];

        $response = $this->postJson('/api/booking/create', $bookingData);

        $response->assertStatus(422);
    }

}
