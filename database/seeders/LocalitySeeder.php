<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locality;
use App\Models\Region;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Locality::truncate();
        //
        $regions = Region::all();

        foreach($regions as $region) {
            Locality::factory()
            ->count(2)
            ->for($region)
            ->create();
        }

    }
}
