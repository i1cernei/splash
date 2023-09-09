<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Locality;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Company::truncate();
        
        Company::factory()
        ->count(100)
        // ->for(Locality::all()->random())
        ->state(new Sequence(
            fn (Sequence $sequence) => ['locality_id' => Locality::all()->random()->id],
        ))
        ->create();
    }
}
