<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            ['name' => 'Damascus'],
            ['name' => 'Daraa'],
            ['name' => 'Homs'],
            ['name' => 'Gaza'],
            ['name' => 'Aleppo'],
            ['name' => 'Latakia'],
            ['name' => 'Lebanon'],
        ];
        Destination::insert($destinations);
    }
}
