<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Quotee;
use App\Quote;
use App\Profession;
use App\Nationality;

class QuoteeTest extends TestCase
{
    public function testQuoteeQuotesRelationship()
    {
        // Create a new quotee
        $quotee = new Quotee();

        // Use the relationship method to get the quotes relationship
        $quotesRelation = $quotee->quotes();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\HasMany
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $quotesRelation);

        // Check if the related model is Quote
        $related = $quotesRelation->getRelated();
        $this->assertInstanceOf(Quote::class, $related);
    }

    public function testQuoteeProfessionRelationship()
    {
        // Create a new quotee
        $quotee = new Quotee();

        // Use the relationship method to get the profession relationship
        $professionRelation = $quotee->profession();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\BelongsTo
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $professionRelation);

        // Check if the related model is Profession
        $related = $professionRelation->getRelated();
        $this->assertInstanceOf(Profession::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $professionRelation->getForeignKey();
        $this->assertEquals('profession_id', $foreignKey);
    }

    public function testQuoteeNationalityRelationship()
    {
        // Create a new quotee
        $quotee = new Quotee();

        // Use the relationship method to get the nationality relationship
        $nationalityRelation = $quotee->nationality();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\BelongsTo
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $nationalityRelation);

        // Check if the related model is Nationality
        $related = $nationalityRelation->getRelated();
        $this->assertInstanceOf(Nationality::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $nationalityRelation->getForeignKey();
        $this->assertEquals('nationality_id', $foreignKey);
    }
}
