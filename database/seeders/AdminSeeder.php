<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'FirstName' => 'admin',
            'LastName' => 'admin',
            'email' => 'nour@gmail.com',
            'phone_number' => '0987454545',
            'role_id' => 1,
            'password' => Hash::make('12121212'),
            'StatusCode'=>true
        ]);

        Wallet::create([
            'user_id' => 1,
            'quantity' => 0
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'age' => 3967,
        //     'role_id' => 2,
        //     'password' => Hash::make('23456789'),
        //     'StatusCode' => true
        // ]);
    }
}
