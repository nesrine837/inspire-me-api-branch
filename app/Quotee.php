<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotee extends Model
{
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
}
