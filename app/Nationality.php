<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    //
    public function quotees()
    {
        return $this->hasMany(Quotee::class);
    }
}
