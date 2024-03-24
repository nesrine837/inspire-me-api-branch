<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Profession;
use App\Quotee;

class ProfessionTest extends TestCase
{
    public function testProfessionQuoteeRelationship()
    {
        // Create a new profession
        $profession = new Profession();

        // Use the relationship method to get the quotee relationship
        $quoteeRelation = $profession->quotees();

        // Check if the relationship returns an instance of Illuminate\Database\Eloquent\Relations\HasMany
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $quoteeRelation);

        // Check if the related model is Quotee
        $related = $quoteeRelation->getRelated();
        $this->assertInstanceOf(Quotee::class, $related);

        // Check if the foreign key used in the relationship is correct
        $foreignKey = $quoteeRelation->getForeignKeyName();
        $this->assertEquals('profession_id', $foreignKey);
    }
}
