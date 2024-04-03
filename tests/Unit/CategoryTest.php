<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Category;
use App\Quote;

class CategoryTest extends TestCase
{
    public function testCategoryQuoteRelationship()
    {
        // Create a new category
        $category = new Category();

        // Use the relationship method to get the quote relationship
        $quoteRelation = $category->quotes();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\HasMany
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $quoteRelation);

        // Check if the related model is Quote
        $related = $quoteRelation->getRelated();
        $this->assertInstanceOf(Quote::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $quoteRelation->getForeignKeyName();
        $this->assertEquals('category_id', $foreignKey);
    }
}
