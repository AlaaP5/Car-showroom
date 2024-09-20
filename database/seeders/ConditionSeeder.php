<?php

namespace Database\Seeders;

use App\Models\Condition;
use App\Models\Payment;
use App\Models\Status;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = ['restricted','acceptable'];

        foreach($conditions as $condition)
            Status::create([
                'name' => $condition
            ]);
    }
}
