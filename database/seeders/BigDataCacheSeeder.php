<?php

namespace Database\Seeders;

use App\Models\BigDataCache;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BigDataCacheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 250; $i++) {
            BigDataCache::factory(20000)->create();
        }
    }
}
