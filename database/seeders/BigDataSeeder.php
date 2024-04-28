<?php

namespace Database\Seeders;

use App\Models\BigData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BigDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 250; $i++) {
            BigData::factory(20000)->create();
        }
    }
}
