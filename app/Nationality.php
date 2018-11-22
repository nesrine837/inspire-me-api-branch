<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    //
    public function quotees()
    {
        return $this->hasMany(Quotee::class);
    }
}
