<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Quote;
use App\Quotee;
use App\Category;

class QuoteTest extends TestCase
{
    public function testQuoteQuoteeRelationship()
    {
        // Create a new quote
        $quote = new Quote();

        // Use the relationship method to get the quotee relationship
        $quoteeRelation = $quote->quotee();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\BelongsTo
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $quoteeRelation);

        // Check if the related model is Quotee
        $related = $quoteeRelation->getRelated();
        $this->assertInstanceOf(Quotee::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $quoteeRelation->getForeignKey();
        $this->assertEquals('quotee_id', $foreignKey);
    }

    public function testQuoteCategoryRelationship()
    {
        // Create a new quote
        $quote = new Quote();

        // Use the relationship method to get the category relationship
        $categoryRelation = $quote->category();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\BelongsTo
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $categoryRelation);

        // Check if the related model is Category
        $related = $categoryRelation->getRelated();
        $this->assertInstanceOf(Category::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $categoryRelation->getForeignKey();
        $this->assertEquals('category_id', $foreignKey);
    }
}
