<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterTripTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagination_trips()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $destination = Destination::factory()->create();

        Trip::factory()->count(15)->create([
            'destination_id' => $destination->id,
            'price' => 123.22,
            'start_date' => '2024-10-07',
            'end_date' => '2024-10-10',
            'available_seats' => 5,
        ]);

        Trip::factory()->count(5)->create([
            'destination_id' => $destination->id,
            'price' => 123.22,
            'start_date' => '2024-11-01',
            'end_date' => '2024-11-10',
            'available_seats' => 10,
        ]);

        $response = $this->getJson('/api/trip/index');

        $response->assertStatus(200);
    }


    public function test_search_trips_byDestination()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $destination = Destination::factory()->create(['name' => 'Test Destination']);

        Trip::factory()->count(3)->create([
            'destination_id' => $destination->id,
            'price' => 123.22,
            'start_date' => '2024-11-01',
            'end_date' => '2024-11-10',
            'available_seats' => 10,
        ]);

        $response = $this->getJson('api/trip/index?destination=t');
        $response->assertStatus(200);

        $response = $this->getJson('api/trip/index?destination=gg');
        $response->assertStatus(404);
    }


    public function test_search_trips_byDates()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $destination = Destination::factory()->create();

        Trip::factory()->count(3)->create([
            'destination_id' => $destination->id,
            'price' => 123.22,
            'start_date' => '2024-12-01',
            'end_date' => '2024-12-10',
            'available_seats' => 10,
        ]);

        $response = $this->getJson('api/trip/index?start_date=2024-11-23 && end_date=2024-12-02');
        $response->assertStatus(200);

        $response = $this->getJson('api/trip/index?start_date=2024-12-03 && end_date=2024-12-08');
        $response->assertStatus(404);
    }


    public function test_search_trips_byAvailableSeats()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $destination = Destination::factory()->create();

        Trip::factory()->count(3)->create([
            'destination_id' => $destination->id,
            'price' => 123.22,
            'start_date' => '2024-11-01',
            'end_date' => '2024-11-10',
            'available_seats' => 10,
        ]);

        $response = $this->getJson('api/trip/index?available_seats=3');
        $response->assertStatus(200);

        $response = $this->getJson('api/trip/index?available_seats=11');
        $response->assertStatus(404);
    }


    public function test_search_trips_byDestination_and_Dates()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $destination1 = Destination::factory()->create(['name' => 'Damascus']);

        $destination2 = Destination::factory()->create(['name' => 'Homs']);

        Trip::factory()->count(15)->create([
            'destination_id' => $destination1->id,
            'price' => 123.22,
            'start_date' => '2024-12-07',
            'end_date' => '2024-12-10',
            'available_seats' => 5,
        ]);

        Trip::factory()->count(5)->create([
            'destination_id' => $destination2->id,
            'price' => 123.22,
            'start_date' => '2024-12-01',
            'end_date' => '2024-12-10',
            'available_seats' => 10,
        ]);

        $response = $this->getJson('/api/trip/index?destination=da && start_date=2024-12-01 && end_date=2024-12-09');

        $response->assertStatus(200);

        $response = $this->getJson('/api/trip/index?destination=da && start_date=2024-12-09 && end_date=2024-12-13');

        $response->assertStatus(404);
    }


    public function test_search_trips_byDestination_and_Dates_and_AvailableSeats()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $destination1 = Destination::factory()->create(['name' => 'Damascus']);

        $destination2 = Destination::factory()->create(['name' => 'Homs']);

        Trip::factory()->count(15)->create([
            'destination_id' => $destination1->id,
            'price' => 123.22,
            'start_date' => '2024-12-07',
            'end_date' => '2024-12-10',
            'available_seats' => 5,
        ]);

        Trip::factory()->count(5)->create([
            'destination_id' => $destination2->id,
            'price' => 123.22,
            'start_date' => '2024-12-15',
            'end_date' => '2024-12-22',
            'available_seats' => 10,
        ]);

        $response = $this->getJson('/api/trip/index?destination=da && start_date=2024-10-02 && end_date=2024-10-01 && available_seats = 9');

        $response->assertStatus(422);

        $response = $this->getJson('/api/trip/index?destination=da && start_date=2024-12-07 && end_date=2024-12-18 && available_seats = 5');

        $response->assertStatus(200);

        $response = $this->getJson('/api/trip/index?destination=da && start_date=2024-12-17 && end_date=2024-12-20 && available_seats = 9');

        $response->assertStatus(404);
    }
}
