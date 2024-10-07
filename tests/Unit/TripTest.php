<?php

namespace Tests\Unit;

use App\Models\Destination;
use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    public function test_trip_creation_successfully()
    {
        $destination = Destination::factory()->create();

        $tripData = [
            'destination_id' => $destination->id,
            'price' => 150.00,
            'available_seats' => 20,
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(10)
        ];

        $trip = Trip::create($tripData);

        $this->assertInstanceOf(Trip::class, $trip);

        $this->assertEquals($tripData['destination_id'], $trip->destination_id);
        $this->assertEquals($tripData['price'], $trip->price);
        $this->assertEquals($tripData['available_seats'], $trip->available_seats);
        $this->assertEquals($tripData['start_date'], $trip->start_date);
        $this->assertEquals($tripData['end_date'], $trip->end_date);
    }


    public function test_trip_creation_fails_with_invalid_dates()
    {
        $destination = Destination::factory()->create();

        $tripData = [
            'destination_id' => $destination->id,
            'price' => 150.00,
            'available_seats' => 20,
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(5)
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = new \App\Http\Requests\TripValidate();
        $request->merge($tripData);

        $this->app['validator']->validate($request->all(), $request->rules());

        Trip::create($tripData);
    }


    public function test_trip_creation_fails_without_required_fields()
    {
        $tripData = [];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = new \App\Http\Requests\TripValidate();
        $request->merge($tripData);

        $this->app['validator']->validate($request->all(), $request->rules());

        Trip::create($tripData);
    }


    public function test_trip_creation_fails_with_negative_price()
    {
        $destination = Destination::factory()->create();

        $tripData = [
            'destination_id' => $destination->id,
            'price' => -50.00,
            'available_seats' => 20,
            'start_date' => now()->addDays(5),
            'end_date' => now()->addDays(10)
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = new \App\Http\Requests\TripValidate();
        $request->merge($tripData);

        $this->app['validator']->validate($request->all(), $request->rules());

        Trip::create($tripData);
    }


    public function test_trip_creation_fails_with_past_start_date()
    {
        $destination = Destination::factory()->create();

        $tripData = [
            'destination_id' => $destination->id,
            'price' => 150.00,
            'available_seats' => 20,
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(5),
            'statusTrip' => 'pending',
        ];

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $request = new \App\Http\Requests\TripValidate();
        $request->merge($tripData);

        $this->app['validator']->validate($request->all(), $request->rules());

        Trip::create($tripData);
    }
    
}
