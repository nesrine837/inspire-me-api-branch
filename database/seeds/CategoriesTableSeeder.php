<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Add test data for categories
        Category::create(['category_name' => 'Category 1']);
        Category::create(['category_name' => 'Category 2']);
        // Add more categories as needed
    }
}

