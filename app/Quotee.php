<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotee extends Model
{
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}
