<?php

use Illuminate\Database\Seeder;
use App\Quote;

class QuotesTableSeeder extends Seeder
{
    public function run()
    {
        // Add test data for quotes
        Quote::create([
            'quote_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'quotee_id' => 1, // Assuming quotee_id 1 exists in the quotees table
            'category_id' => 1, // Assuming category_id 1 exists in the categories table
            'keywords' => 'Lorem, ipsum, dolor',
        ]);

        Quote::create([
            'quote_content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'quotee_id' => 2, // Assuming quotee_id 2 exists in the quotees table
            'category_id' => 2, // Assuming category_id 2 exists in the categories table
            'keywords' => 'Sed, do, eiusmod',
        ]);

        // Add more quotes as needed
    }
}
