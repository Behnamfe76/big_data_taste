<?php

namespace Database\Seeders;

use App\Models\BigDataIndex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BigDataIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 250; $i++) {
            BigDataIndex::factory(20000)->create();
        }
    }
}
