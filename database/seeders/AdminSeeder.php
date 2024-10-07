<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
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
        $users = [
            [
                'name' => 'rand1',
                'email' => 'rand1@gmail.com',
                'password' => Hash::make('11229988'),
                'role' => 'admin',
                'statusCode' => true,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', now())
            ],
            [
                'name' => 'rand2',
                'email' => 'rand2@gmail.com',
                'password' => Hash::make('11229988'),
                'role' => 'admin',
                'statusCode' => true,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', now())
            ],
        ];
        User::insert($users);
    }
}
