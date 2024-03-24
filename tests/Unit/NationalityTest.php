<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Nationality;
use App\Quotee;

class NationalityTest extends TestCase
{
    public function testNationalityQuoteesRelationship()
    {
        // Create a new nationality
        $nationality = new Nationality();

        // Use the relationship method to get the quotees relationship
        $quoteesRelation = $nationality->quotees();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\HasMany
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $quoteesRelation);

        // Check if the related model is Quotee
        $related = $quoteesRelation->getRelated();
        $this->assertInstanceOf(Quotee::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $quoteesRelation->getForeignKeyName();
        $this->assertEquals('nationality_id', $foreignKey);
    }
}
