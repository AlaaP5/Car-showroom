<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cases = ["unpaid","paidC","paidI"];

        foreach($cases as $Role)
            Status::create([
                "name" => $Role
            ]);
    }
}
