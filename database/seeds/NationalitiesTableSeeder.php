<?php

use Illuminate\Database\Seeder;
use App\Nationality;

class NationalitiesTableSeeder extends Seeder
{
    public function run()
    {
        // Add test data for nationalities
        Nationality::create(['nationality_name' => 'Nationality 1']);
        Nationality::create(['nationality_name' => 'Nationality 2']);
        // Add more nationalities as needed
    }
}
