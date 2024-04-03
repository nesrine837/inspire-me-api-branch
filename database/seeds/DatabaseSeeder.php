<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Call other seeders here if necessary
        $this->call([
            CategoriesTableSeeder::class,
            NationalitiesTableSeeder::class,
            ProfessionsTableSeeder::class,
            QuoteesTableSeeder::class,
            UsersTableSeeder::class,
            QuotesTableSeeder::class,
            // Add other seeders here
        ]);
    }
}
