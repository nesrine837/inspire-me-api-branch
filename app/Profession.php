<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //
    public function quotees()
    {
        return $this->hasMany(Quotee::class);
    }
}
