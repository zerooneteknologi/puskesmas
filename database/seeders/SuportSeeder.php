<?php

namespace Database\Seeders;

use App\Models\Suport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Suport::factory()
            ->count(5)
            ->create();
    }
}
