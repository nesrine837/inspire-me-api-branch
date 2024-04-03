<?php

use Illuminate\Database\Seeder;
use App\Quotee;

class QuoteesTableSeeder extends Seeder
{
    public function run()
    {
        // Add test data for quotees
        Quotee::create([
            'quotee_name' => 'Quotee 1',
            'biography_link' => 'https://example.com/quotee-1-bio',
            'profession_id' => 1, // Assuming profession_id 1 exists in the professions table
            'nationality_id' => 1, // Assuming nationality_id 1 exists in the nationalities table
            'quotee_gender' => 'm',
        ]);

        Quotee::create([
            'quotee_name' => 'Quotee 2',
            'biography_link' => 'https://example.com/quotee-2-bio',
            'profession_id' => 2, // Assuming profession_id 2 exists in the professions table
            'nationality_id' => 2, // Assuming nationality_id 2 exists in the nationalities table
            'quotee_gender' => 'f',
        ]);

        // Add more quotees as needed
    }
}
