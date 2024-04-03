<?php

use Illuminate\Database\Seeder;
use App\Profession;

class ProfessionsTableSeeder extends Seeder
{
    public function run()
    {
        // Add test data for professions
        Profession::create(['profession_name' => 'Profession 1']);
        Profession::create(['profession_name' => 'Profession 2']);
        // Add more professions as needed
    }
}
