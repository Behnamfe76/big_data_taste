<?php

namespace Database\Seeders;

use App\Models\BigDataCacheIndex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BigDataCacheIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 250; $i++) {
            BigDataCacheIndex::factory(20000)->create();
        }
    }
}
